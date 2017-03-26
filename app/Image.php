<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Http\UploadedFile;
    use Illuminate\Support\Facades\Storage;

    /**
     * Class Image
     *
     * @package App
     * @mixin \Eloquent
     * @property int            $id
     * @property string         $name
     * @property string         $filename
     * @property string         $url_name
     * @property string         $extension
     * @property string         $filetype
     * @property string         $file_path
     * @property int            $domain
     * @property string         $uploaded_from
     * @property int            $image_created_on
     * @property \Carbon\Carbon $created_at
     * @property \Carbon\Carbon $updated_at
     * @property int            $deleted_at
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
     * @property int            $user_id
     * @property-read \App\User $user
     * @method static \Illuminate\Database\Query\Builder|\App\Image whereUserId($value)
     */
    class Image extends Model {
        use SoftDeletes;
        /** @var UploadedFile $uploadedFile */
        protected $uploadedFile;
        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'uploaded_from', 'file_path', 'updated_at', 'deleted_at', 'id'
        ];

        /**
         * Get the format for database stored dates.
         *
         * @return string
         */
        protected function getDateFormat() {
            return 'U';
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function user() {
            return $this->belongsTo('App\User');
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function domain() {
            return $this->belongsTo('App\Domain', 'domain');
        }

        /**
         * @return string
         */
        public function getBaseName() {
            return $this->filename . '.' . $this->extension;
        }

        /**
         * @return mixed|void
         */
        public function getUrlToImage() {
            if (config('filesystems.default') == 'local') {
                // TODO domain
                $domain = $this->domain();
                return $domain->getResults();
            } else {
                return $this->getImageUrlFromStorage();
            }
        }

        public function getImageUrlFromStorage() {
            Storage::url($this->file_path . '/' . $this->getBaseName());
        }

        /**
         * @param UploadedFile $file
         *
         * @return Image
         */
        public static function processNew(UploadedFile $file) {
            $image = new self;

            $image->uploadedFile     = $file;
            $imageName               = str_random(6);
            $image->url_name         = $imageName;
            $image->filename         = $imageName;
            $image->extension        = $file->extension();
            $image->filetype         = $file->getMimeType();
            $image->image_created_on = time(); // Todo: extract from metadata
            return $image;
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
         * Delete the model from the database.
         *
         * @return bool|null
         *
         * @throws \Exception
         */
        public function delete() {
            $deleteFile = $this->deleteImageFile();
            if (!$deleteFile) return false;
            return parent::delete();
        }

        /**
         * @return bool
         */
        private function deleteImageFile() {
            return Storage::delete($this->file_path . $this->getBaseName());
        }

    }
