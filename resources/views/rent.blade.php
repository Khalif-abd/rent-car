@extends('layouts.app')

@section('title', 'Аренда автомобиля')

@section('content_header')
    <h1>Аренда автомобиля</h1>
@endsection

@section('content')

    <section>

        <div class="container lg:w-1/2 px-5 py-20 mx-auto">

            <div class="mb-5">
                <h2 class="mt-4 mb-12 text-3xl font-semibold text-center text-gray-800 capitalize">
                    Аренда автомобиля
                </h2>
            </div>
            <div class="p-6 lg:w-1/2 mx-auto bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 md:p-8">
                <form id="form" class="space-y-6">
                    <div class="mb-4">
                        <label for="user" class="block mb-4 text-sm font-medium text-gray-900 dark:text-gray-300">Водитель</label>
                        <select id="user"
                                onchange="getStatus()"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="car" class="block mb-4 text-sm font-medium text-gray-900">Автомобиль</label>
                        <select id="car"
                                onchange="getStatus()"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">
                            @foreach($cars as $car)
                                <option
                                    value="{{ $car->id }}">{{ sprintf('%s %s (номер %s)', $car->model->brand->name, $car->model->name,  $car->number)  }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-center mt-4 space-x-4">
                        <button id="btn" type="button" onclick="rent()"
                                class="text-white bg-blue-600 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Арендовать
                        </button>
                        <button id="remove_btn" type="button" onclick="completeLeaseCar()"
                                class="text-white hidden bg-red-500 focus:ring-2 focus:outline-none focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Завершить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>

        document.addEventListener('DOMContentLoaded', () => {
            getStatus()
        });

        const btn = document.getElementById("btn");
        const remove_btn = document.getElementById("remove_btn");
        const svgLoader = `<svg aria-hidden="true" class="inline mr-3 w-4 h-4 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                </svg>
                                Загрузка`;

        const getStatus = () => {

            const user_id = document.getElementById('user').value;
            const car_id = document.getElementById('car').value;

            btn.innerHTML = svgLoader


            axios.get(`/api/get-rent-status/${user_id}/${car_id}`,
                {
                    headers: {'Content-Type': 'application/json'}
                }
            )
                .then((res) => {
                    btn.innerHTML = 'Арендовать'
                    btn.removeAttribute('disabled');
                    btn.classList.remove("opacity-75")
                    remove_btn.classList.add("hidden")
                })
                .catch((e) => {
                    btn.setAttribute("disabled", "disabled");
                    btn.classList.add("opacity-75")
                    btn.innerHTML = 'Занято'
                    remove_btn.classList.remove("hidden")
                })

        }

        const rent = () => {

            const user_id = document.getElementById('user').value;
            const car_id = document.getElementById('car').value;

            btn.innerHTML = svgLoader

            axios.get(`/api/rent-car/${user_id}/${car_id}`,
                {
                    headers: {'Content-Type': 'application/json'}
                }
            )
                .then((res) => {

                        btn.setAttribute("disabled", "disabled");
                        btn.classList.add("opacity-75")
                        btn.innerHTML = 'Занято'
                        remove_btn.classList.remove("hidden")

                        alert(res.data.message)
                    }
                )
                .catch((e) => alert(e.response.data))

        }

        const completeLeaseCar = () => {

            const car_id = document.getElementById('car').value;

            remove_btn.innerHTML = svgLoader

            axios.get(`/api/complete-lese-car/${car_id}`,
                {
                    headers: {'Content-Type': 'application/json'}
                }
            )
                .then((res) => {
                        btn.innerHTML = 'Арендовать'
                        btn.removeAttribute('disabled');
                        btn.classList.remove("opacity-75")
                        remove_btn.innerHTML = 'Завершить'
                        remove_btn.classList.add("hidden")

                        alert(res.data.message)
                    }
                )
                .catch((e) => alert(e.response.data.errors.messages[0]))
        }

    </script>
@endsection
