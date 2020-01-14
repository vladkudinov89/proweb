@csrf

<div class="form-group">
    <label class="label text-sm mb-2 block" for="title">Имя</label>

    <div class="control">
        <input
            type="text"
            class="input bg-transparent border border-muted-light rounded p-2 text-xs w-50
            @if($errors->has('name')) error @endif"
            name="name"
            placeholder="User Name"
            value="@if(old('name')){{old('name')}}@else{{ $user->name ?? ""  }}@endif"
        >
    </div>

    @if($errors->has('name'))
        <div class="alert alert-danger w-50">{{$errors->first('name')}}</div>
    @endif
</div>

<div class="form-group">
    <label class="label text-sm mb-2 block" for="description">О Себе</label>

    <div class="control">
            <textarea
                name="about"
                rows="10"
                class="textarea bg-transparent border border-muted-light rounded p-2 text-xs w-50
                @if($errors->has('about')) error @endif"
                placeholder="Task Description"
            >@if(old('about')){{old('about')}}@else{{ $user->about ?? ""  }}@endif</textarea>
    </div>
    @if($errors->has('about'))
        <div class="alert alert-danger w-50">{{$errors->first('about')}}</div>
    @endif
</div>

<div class="form-group">
    <label class="label text-sm mb-3 block" for="title">Пол</label>

    <div>
        <select name="gender" id="status" class="w-25">
            <option value="male"
            @if($user->gender === 'male'){{"selected"}}@else{{ "" }}@endif
            >Male
            </option>
            <option value="female"
            @if($user->gender === 'female'){{"selected"}}@else{{ "" }}@endif
            >Female
            </option>
        </select>
    </div>
</div>

<div class="">
    <button type="submit" class="btn btn-primary w-50">Save</button>
</div>
