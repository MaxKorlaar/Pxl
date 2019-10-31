<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    /**
     * Class Domain
     *
     * @package App
     * @property int                                                        $id
     * @property string                                                     $domain
     * @property string                                                     $protocol
     * @property string                                                     $user
     * @property \Carbon\Carbon                                             $created_at
     * @property \Carbon\Carbon                                             $updated_at
     * @method static \Illuminate\Database\Query\Builder|\App\Domain whereCreatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Domain whereDomain($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Domain whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Domain whereProtocol($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Domain whereUpdatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Domain whereUser($value)
     * @mixin \Eloquent
     * @property-read \App\User                                             $ownedBy
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Image[] $images
     * @property string                                                     $domain_id
     * @method static \Illuminate\Database\Query\Builder|\App\Domain whereDomainId($value)
     */
    class Domain extends Model {
        protected $uploadedFile;
        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [

        ];

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function ownedBy() {
            return $this->belongsTo('App\User', 'user');
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function images() {
            return $this->hasMany('App\Image');
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
