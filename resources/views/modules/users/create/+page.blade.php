@extends('modules.users.+layout')

@section('title', 'Registrar nuevo usuario')

@php
    $days = range(1, 31);
    $months = [
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre',
    ];
    $years = range(date('Y'), date('Y') - 100);
    $domains = ['lapontificia.edu.pe', 'ilp.edu.pe', 'elp.edu.pe', 'ec.edu.pe', 'idiomas.edu.pe'];

@endphp

@section('layout.users')
    @if ($cuser->has('users:create') || $cuser->isDev())
        <div class="text-black max-w-2xl w-full flex-grow">
            <div class="flex items-center border-b justify-between p-2">
                <button onclick="window.history.back()" class="flex gap-2 items-center text-gray-900 ">
                    @svg('fluentui-arrow-left-20', 'w-5 h-5')
                    Registrar nuevo usuario
                </button>
            </div>
            <div class="p-5 flex-grow mt-2 w-full overflow-y-auto ">
                <form class="grid gap-4 w-full" role="form">
                    <div class="flex items-center gap-4">
                        <div class="relative rounded-full overflow-hidden w-24 aspect-square">
                            <input type="file" name="profile" id="input-profile"
                                class="opacity-0 absolute peer inset-0 w-full h-full cursor-pointer" accept="image/*">
                            <img id="preview-profile" class="w-full peer-data-[fill]:block hidden h-full object-cover"
                                src="https://res.cloudinary.com/dc0t90ahb/image/upload/v1706396604/gxhlhgd1aa7scbneae3s.jpg"
                                alt="">
                            @svg('fluentui-person-circle-20-o', 'w-full peer-data-[fill]:hidden block h-full opacity-50')
                        </div>
                        <button onclick="document.getElementById('input-profile').click()" type="button" class="secondary">
                            @svg('fluentui-image-add-20-o', 'w-5 h-5')
                            Subir foto
                        </button>
                    </div>
                    <div class="grid gap-4">
                        <div class="border-t pt-2 text-lg">
                            <p>
                                Detalles del usuario
                            </p>
                        </div>
                        <div class="grid dinamic-form grid-cols-2 gap-4">
                            <div class="col-span-2 grid grid-cols-2">
                                <label class="label">
                                    <span>Documento de Identidad</span>
                                    <input pattern="[0-9]{8}" name="dni" id="dni-input" autocomplete="off"
                                        value="" required type="number">
                                </label>
                            </div>
                            <label class="label">
                                <span>Apellidos</span>
                                <input autocomplete="off" value="" name="last_name" id="last_name-input" required
                                    type="text">
                            </label>
                            <label class="label">
                                <span>Nombres</span>
                                <input autocomplete="off" value="" name="first_name" id="first_name-input" required
                                    type="text">
                            </label>
                            <label class="label">
                                <span>Fecha de nacimiento</span>
                                <div class="w-full">
                                    <select required name="date_of_birth_day">
                                        <option value="" selected disabled>
                                            Día
                                        </option>
                                        @foreach ($days as $day)
                                            <option value="{{ $day }}">
                                                {{ $day }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <select required name="date_of_birth_month">
                                        <option value="" selected disabled>
                                            Mes
                                        </option>
                                        @foreach ($months as $key => $month)
                                            <option value="{{ $key + 1 }}">
                                                {{ $month }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <select required name="date_of_birth_year">
                                        <option value="" selected disabled>
                                            Año
                                        </option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}">
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </label>
                        </div>
                        <div class="border-t pt-2 text-lg">
                            <p>
                                Organización y horarios
                            </p>
                        </div>
                        <div class="grid dinamic-form grid-cols-2 gap-4">
                            <label class="label">
                                <span>
                                    Puesto de Trabajo
                                </span>
                                <select name="id_job_position" id="job-position-select" required>
                                    @foreach ($job_positions as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="label">
                                <span>
                                    Cargo
                                </span>
                                <select name="id_role" id="role-select" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="label">
                                <span>
                                    Sede
                                </span>
                                <select name="id_branch" required>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">
                                            {{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="label">
                                <span>Grupo de horario</span>
                                <div class="relative">
                                    <div class="absolute top-0 z-10 inset-y-0 grid place-content-center left-3">
                                        @svg('fluentui-calendar-ltr-24-o', 'w-4 text-stone-500')
                                    </div>
                                    <select class="w-full" style="padding-left: 35px" name="group_schedule_id">
                                        <option disabled selected>Grupo de horario</option>
                                        @foreach ($group_schedules as $scheldule)
                                            <option value="{{ $scheldule->id }}">{{ $scheldule->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </label>
                            <label class="label">
                                <span>Terminal por defecto</span>
                                <div class="relative">
                                    <div class="absolute top-0 z-10 inset-y-0 grid place-content-center left-3">
                                        @svg('fluentui-calendar-ltr-24-o', 'w-4 text-stone-500')
                                    </div>
                                    <select class="w-full" style="padding-left: 35px" name="default_assist_terminal">
                                        <option disabled selected>Terminal de asistencias por defecto</option>
                                        @foreach ($terminals as $terminal)
                                            <option value="{{ $terminal->id }}">{{ $terminal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </label>
                        </div>
                        <div class="border-t pt-2 text-lg">
                            <p>
                                Rol y privilegios
                            </p>
                        </div>
                        <div class="grid dinamic-form grid-cols-2 gap-4">
                            <label class="label w-[200px]">
                                <span>Rol</span>
                                <select required name="id_role_user">
                                    @foreach ($user_roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class="border-t pt-2 text-lg">
                            <p>
                                Seguridad y acceso
                            </p>
                        </div>
                        <div class="grid gap-3">
                            <div class="label w-full">
                                <span>Nombre de usuario</span>
                                <div class="relative">
                                    <div class="absolute z-10 inset-y-0 flex items-center left-3">
                                        @svg('fluentui-mail-20-o', 'w-5 h-5 opacity-50')
                                    </div>
                                    <input pattern="^[a-zA-Z0-9_]*$" value="" required type="text" name="username"
                                        class="w-full pl-10" placeholder="Nombre de usuario">
                                    <div class="absolute inset-y-0 flex gap-1 items-center right-2">
                                        <div class="opacity-50">
                                            @
                                        </div>
                                        <div class="label">
                                            <select style="background-color: transparent; border: 0px; padding: 0px;"
                                                required name="domain">
                                                @foreach ($domains as $domain)
                                                    <option value="{{ $domain }}">
                                                        {{ $domain }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="label">
                                <span>
                                    Contraseña
                                </span>
                                <div class="relative">
                                    <div class="absolute z-10 inset-y-0 flex items-center left-3">
                                        @svg('fluentui-person-key-20-o', 'w-5 h-5 opacity-50')
                                    </div>
                                    <input name="password" placeholder="Opcional" class="w-full pl-10">
                                </div>
                                <p class="text-xs">
                                    La contraseña por defecto será el documento de identidad del usuario.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="border-t pt-2 border-neutral-300">
                        <div class="max-w-2xl mx-auto flex gap-2">
                            <button type="submit" class="primary">
                                @svg('fluentui-person-add-20-o', 'w-5 h-5')
                                Registrar
                            </button>
                            <button onclick="window.history.back()" type="button" class="secondary">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        @include('+403', [
            'message' => 'No tienes permisos para crear usuarios.',
        ])
    @endif
@endsection
