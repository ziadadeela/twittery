<?php namespace App\Actions\User;

use App\User;

class UpdateUserAction
{
    /**
     * @param User $user
     * @param $data
     * @return User|int
     */
    public function update(User $user, $data)
    {
        if (isset($data['password']) and $data['password']) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);


//        $collectionName = 'profile_picture';
//        try {
//            if (request()->hasFile('profile_picture')) {
//                $user->deleteFile($user->id, User::class, $collectionName);
//                $user->saveAttachments('profile_picture', $collectionName);
//            }
//
//        } catch (\Exception $exception) {
//
//        }
        return $user;
    }

}

