<?php

namespace App\Exceptions;


use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use Throwable;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    /**
     * Метод визуализации исключений.
     *
     * @param Request $request
     * @param Throwable $e
     * @return JsonResponse|Response
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response|JsonResponse
    {
        if (!str_starts_with($request->path(), 'api/')) {
            return parent::render($request, $e);
        }

        $message = '';
        switch (get_class($e)) {
            case 'Illuminate\Database\Eloquent\ModelNotFoundException':
                $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
                $message = 'Нет результатов запроса.';
                break;
            case 'TypeError':
                $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
                $message = $e->getMessage() ?: '422 | Не корректный тип ключа';
                break;
            case 'Symfony\Component\HttpKernel\Exception\NotFoundHttpException':
                $statusCode = Response::HTTP_NOT_FOUND;
                $message = 'ресурс не найден';
                break;
            case 'Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException':
                $statusCode = Response::HTTP_METHOD_NOT_ALLOWED;
                $message = 'Данный метод не поддерживается';
                break;
            case 'Illuminate\Database\QueryException':
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                $message = 'Ошибка в работе базы данных';
                break;
            case 'BadMethodCallException':
            case 'Illuminate\Http\Client\ConnectionException':
                $statusCode = Response::HTTP_SERVICE_UNAVAILABLE;
                $message = ' Сервис недоступен';
                break;
            case 'Illuminate\Http\Client\HttpClientException':
                $statusCode = $e->getCode() ?: Response::HTTP_UNPROCESSABLE_ENTITY;
                break;
            case 'Elasticsearch\Common\Exceptions\Forbidden403Exception':
                $message = 'Недостаточно прав';
                $statusCode = Response::HTTP_FORBIDDEN;
                break;
            case 'Illuminate\Auth\AuthenticationException':
                $message = 'Недостаточно прав';
                $statusCode = Response::HTTP_UNAUTHORIZED;
                break;
            case 'GuzzleHttp\Exception\ServerException':
                $message = $e->getResponse()->getBody()->getContents();
                $statusCode = $e->getCode() ?: Response::HTTP_UNPROCESSABLE_ENTITY;
                break;
            case 'Illuminate\Http\Exceptions\ThrottleRequestsException':
                $message = 'Превышен лимит запросов';
                $statusCode = Response::HTTP_TOO_MANY_REQUESTS;
                break;
            default:
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                $message = 'Неизвестная ошибка';
        }

        $response = [
            'errors' => [
                'messages' => [
                    $message ?: ($e->getMessage() ?: 'Неизвестная ошибка'),
                ],
            ],
        ];

        return response()->json(
            $response,
            $statusCode,
            [],
            App::environment(['production']
            ) ? null : JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
        );
    }
}
