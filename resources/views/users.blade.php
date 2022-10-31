@extends('layouts.app')

@section('title', 'Пользователи')

@section('content_header')
    <h1>Пользователи</h1>
@endsection

@section('content')
    <section>
        <div class="overflow-x-auto  relative sm:rounded-lg">
            <table class="lg:w-1/2 mt-8 mb-12 mx-auto text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        ID
                    </th>
                    <th scope="col" class="py-3 px-6">
                        ФИО
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Email
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Статус
                    </th>
{{--                    <th scope="col" class="py-3 px-6">--}}
{{--                        <span class="sr-only">Edit</span>--}}
{{--                    </th>--}}
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr class="bg-white hover:bg-gray-50">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$user->id}}
                        </th>
                        <td class="py-4 px-6">
                            {{$user->name}}
                        </td>
                        <td class="py-4 px-6">
                            {{$user->email}}
                        </td>
                        <td class="py-4 px-6">
                            {{$user->cars()->count() === 1 ? 'Занят' : 'Не занят' }}
                        </td>
{{--                        <td class="py-4 px-6 text-right">--}}
{{--                            <a href="#" class="font-medium text-black-50">--}}
{{--                                <i class="fa fa-edit"></i>--}}
{{--                            </a>--}}
{{--                        </td>--}}
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </section>
@endsection
