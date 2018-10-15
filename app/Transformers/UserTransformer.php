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
            'nombre' => (string)$user->nombre,
            'correo' => (string)$user->email,
            'esVerificado' => (int)$user->verified,
            'esAdministrador' => ($user->admin === true),
            'frechaCreacion' => (string)$user->created_at,
            'frechaActualizacion' => (string)$user->updated_at,
            'frechaEliminacion' => isset($user->deleted_at) ? (string)$user->deleted_at : null,
        ];
    }
}
