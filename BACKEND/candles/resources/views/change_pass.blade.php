
@extends('html_template')

@section('content') 

  <main>
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      
      <div class="form-container">
        <h1>Change Password</h1>
        <form method="POST" action="{{ route('password.change.submit') }}">
            @csrf
            <div class="form-group">
                <label for="oldPassword">Old Password</label>
                <input type="password" class="form-control" id="oldPassword" name="old_password" />
            </div>
            <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input type="password"class="form-control" id="newPassword" name="new_password" placeholder="Enter password" required/>
            </div>
            <div class="form-group">
                <label for="repeatPassword">Repeat New Password:</label>
                <input type="password" class="form-control" id="repeatPassword" name="repeat_password" placeholder="Repeat password" required />
            </div>
            <button type="submit" class="btn-create-account"> Change Password </button>
            </form>
      </div>
  </main>

  @endsection
