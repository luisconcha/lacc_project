<?php
/**
 * File: UserTransformer.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 20/04/16
 * Time: 00:36
 * Project: estudo_laravel
 * Copyright: 2016
 */

namespace LACC\Transformers;

use LACC\Entities\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
        public function transform( User $user )
        {
                return [
                        'user_id'          => $user->id,
                        'user_name'        => $user->name,
                        'user_email'       => $user->email,
                ];
        }
}