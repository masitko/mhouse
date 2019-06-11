<?php

namespace LaravelEnso\Core\app\Http\Controllers\Administration\User;

use Illuminate\Routing\Controller;
use LaravelEnso\Core\app\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Core\app\Classes\ProfileBuilder;
use LaravelEnso\Core\app\Forms\Builders\UserForm;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LaravelEnso\Core\app\Http\Requests\ValidateUserRequest;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function create(Person $person, UserForm $form)
    {
        return ['form' => $form->create($person)];
    }

    public function store(ValidateUserRequest $request)
    {
        $user = new User($request->validated());

        $this->authorize('handle', $user);

        if ($request->filled('password')) {
          $user->password = bcrypt($request->get('password'));
        }

        $user->save();

        $user->sendResetPasswordEmail();

        return [
            'message' => __('The user was successfully created'),
            'redirect' => 'administration.users.edit',
            'param' => ['user' => $user->id],
        ];
    }

    // public function update(ValidateUserRequest $request, User $user)
    public function update(ValidateUserRequest $request, $id)
    {
        // var_dump('update');
        $user = User::find($id);
        $this->authorize('handle', $user);

        if ($request->filled('password')) {
            $this->authorize('change-password', $user);
            $user->password = bcrypt($request->get('password'));
        }

        $user->fill($request->validated());

        if ($user->isDirty('role_id')) {
            $this->authorize('change-role', $user);
        }

        $user->update($request->validated());

        if (collect($user->getChanges())->keys()->contains('password')) {
            event(new PasswordReset($user));
        }

        return ['message' => __('The user was successfully updated')];
    }

    public function show($id)
    {
      $user = User::find($id);
        (new ProfileBuilder($user))->set();

        return ['user' => $user];
    }

    public function edit($id, UserForm $form)
    {
      // var_dump('edit');

      $user = User::find($id);
      // dd($user);
        return ['form' => $form->edit($user)];
    }

    public function destroy(User $user)
    {
        $this->authorize('handle', $user);

        $user->delete();

        return [
            'message' => __('The user was successfully deleted'),
            'redirect' => 'administration.users.index',
        ];
    }
}
