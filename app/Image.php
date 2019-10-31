<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Http\UploadedFile;
    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\Storage;

    /**
     * Class Image
     *
     * @package App
     * @mixin \Eloquent
     * @property int              $id
     * @property string           $name
     * @property string           $filename
     * @property string           $url_name
     * @property string           $extension
     * @property string           $filetype
     * @property string           $file_path
     * @property string           $uploaded_from
     * @property int              $image_created_on
     * @property \Carbon\Carbon   $created_at
     * @property \Carbon\Carbon   $updated_at
     * @property int              $deleted_at
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereCreatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereDeletedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereDomain($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereExtension($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereFilePath($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereFilename($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereFiletype($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereImageCreatedOn($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereName($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereUpdatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereUploadedFrom($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereUrlName($value)
     * @property int              $user_id
     * @property-read \App\User   $user
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereUserId($value)
     * @property int              $domain_id
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereDomainId($value)
     * @property-read \App\Domain $domain
     * @property int              $deletion_timestamp
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereDeletionTimestamp($value)
     */
    class Image extends Model {
        use SoftDeletes;
        /** @var UploadedFile $uploadedFile */
        protected $uploadedFile;
        /** @var \InterventionImage $imageObject */
        protected $imageObject;
        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'uploaded_from', 'file_path', 'updated_at', 'deleted_at', 'id'
        ];

        /**
         * @param UploadedFile $file
         *
         * @return Image
         */
        public static function processNew(UploadedFile $file) {
            $image = new self;

            $image->uploadedFile     = $file;
            $image->name             = $file->getClientOriginalName();
            $imageName               = str_random(6);
            $image->url_name         = $imageName;
            $image->filename         = $imageName;
            $image->extension        = $file->extension();
            $image->filetype         = $file->getMimeType();
            $image->image_created_on = time(); // Todo: extract from metadata
            return $image;
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function user() {
            return $this->belongsTo('App\User');
        }

        /**
         * @return string;
         */
        public function getUrlToImage() {
            if (config('filesystems.default') == 'local') {
                /** @var Domain $domain */
                $domain = $this->domain()->getResults();
                if ($domain == null) return false;
                $url = $domain->protocol . '://' . $domain->domain . '/' . $this->getBaseName();

                return $url;
            } else {
                return $this->getImageUrlFromStorage();
            }
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function domain() {
            return $this->belongsTo('App\Domain');
        }

        /**
         * @return string
         */
        public function getBaseName() {
            return $this->filename . '.' . $this->extension;
        }

        public function getImageUrlFromStorage() {
            Storage::url($this->pathToFile());
        }

        /**
         * @return string
         */
        public function pathToFile() {
            return $this->file_path . '/' . $this->getBaseName();
        }

        /**
         * @return string
         */
        public function getUrlToImagePreview() {
            /** @var Domain $domain */
            $domain = $this->domain()->getResults();
            if ($domain == null) return false;
            $url = $domain->protocol . '://' . $domain->domain . '/' . $this->url_name;
            return $url;
        }

        /**
         * @return bool|int
         */
        public function getEstimatedDeletionTimestamp() {
            if ($this->deletion_timestamp === null) return false;
            return $this->deletion_timestamp;
        }

        /**
         * @param $path
         *
         * @return false|string
         */
        public function storeImage($path) {
            $this->file_path = $path;
            $this->save();
            return $this->uploadedFile->storePubliclyAs($path, $this->getBaseName());
        }

        /**
         * @return mixed
         */
        public function width() {
            $this->makeImage();
            return $this->imageObject->width();
        }

        protected function makeImage() {
            if ($this->imageObject === null) {
                $this->imageObject = \InterventionImage::make(Storage::get($this->pathToFile()));
            }
        }

        /**
         * @return mixed
         */
        public function height() {
            $this->makeImage();
            return $this->imageObject->height();
        }

        /**
         * @return \Intervention\Image\Image
         */
        public function getThumbnail() {
            return \InterventionImage::cache(function ($image) {
                /** @var \InterventionImage $image */
                $image->make(Storage::get($this->pathToFile()))->fit(300, 300, function ($constraint) {
                    /** @var \Intervention\Image\Constraint $constraint */
                    $constraint->upsize();
                });
            }, 900, false);
        }

        /**
         * Delete the model from the database.
         *
         * @return bool|null
         *
         * @throws \Exception
         */
        public function delete() {
            $this->clearCachedData();
            $deleteFile = $this->deleteImageFile();
            if (!$deleteFile) return false;
            return parent::delete();
        }

        private function clearCachedData() {
            Cache::forget('image.' . $this->url_name . '.preview');
            Cache::forget('image.' . $this->url_name . '.domain');
            Cache::forget('image.' . $this->url_name . '.user');
        }

        /**
         * @return bool
         */
        private function deleteImageFile() {
            return Storage::delete($this->pathToFile());
        }

        /**
         * Get the format for database stored dates.
         *
         * @return string
         */
        public function getDateFormat() {
            return 'U';
        }

    }
