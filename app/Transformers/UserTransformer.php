<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identificador' => (int)$user->id,
            'nombre' => (string)$user->name,
            'correo' => (string)$user->email,
            'esVerificado' => (int)$user->verified,
            'esAdministrador' => ($user->admin == true),
            'frechaCreacion' => (string)$user->created_at,
            'frechaActualizacion' => (string)$user->updated_at,
            'frechaEliminacion' => isset($user->deleted_at) ? (string)$user->deleted_at : null,
            'links' => [
                'rel' => 'self',
                'href' => route('users.show', $user->id),
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador' => 'id',
            'nombre' => 'name',
            'correo' => 'email',
            'esVerificado' => 'verified',
            'esAdministrador' => 'admin',
            'frechaCreacion' => 'created_at',
            'frechaActualizacion' => 'updated_at',
            'frechaEliminacion' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identificador',
            'name' => 'nombre',
            'password' => 'password',
            'email' => 'correo',
            'verified' => 'esVerificado',
            'admin' => 'esAdministrador',
            'created_at' => 'frechaCreacion',
            'updated_at' => 'frechaActualizacion',
            'deleted_at' => 'frechaEliminacion',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
