<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response as ResponseConstants;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Response;

class RestResponse
{
    /**
     * Handle errors and return Bad Request
     *
     * @param $errors
     * @return JsonResponse
     */
    public static function badRequest($errors)
    {
        return Response::json(
            ['success' => false, 'errors' => $errors],
            ResponseConstants::HTTP_BAD_REQUEST
        );
    }

    /**
     * Success response
     * Also prepare total details for pagination
     *
     * @param $root
     * @param $data
     * @return mixed
     */
    public static function done($root, $data)
    {
        if ($data instanceof LengthAwarePaginator) {
            return Response::json([
                "success" => true,
                "$root" => $data->toArray()['data'],
                "total" => $data->total(),
            ]);
        } elseif (!isset($root)) {
            if (is_array($data)) {
                $data["success"] = true;
            }

            return Response::json($data);
        }
        return Response::json([
            "success" => true,
            $root => $data,
        ]);
    }

    /**
     * Return pagination to array
     *
     * @param $root
     * @param $data
     * @return array
     */
    public static function paginationToArray($root, LengthAwarePaginator $data)
    {
        return [
            "$root" => $data->toArray()['data'],
            "total" => $data->total(),
        ];
    }

    /**
     * Success response
     *
     * @param $response
     * @return mixed
     */
    public static function successResponse($response)
    {
        $response['success'] = true;
        return Response::json($response);
    }

    /**
     * No content response
     *
     * @return mixed
     */
    public static function noContent()
    {
        return Response::json(['success' => false, 'errors' => ['message' => "No Content found"]], ResponseConstants::HTTP_NO_CONTENT);
    }

    /**
     * No route found response
     *
     * @return mixed
     */
    public static function notFound()
    {
        return Response::json(['success' => false, 'errors' => ['message' => 'Not Found']], ResponseConstants::HTTP_NOT_FOUND);
    }

    /**
     * No Permission Response
     *
     * @return mixed
     */
    public static function noPermission()
    {
        return Response::json(
            ['success' => false, 'errors' => ['message' => 'Permission denied']],
            ResponseConstants::HTTP_FORBIDDEN
        );
    }

    /**
     * Server Error response
     *
     * @return mixed
     */
    public static function serverError()
    {
        return Response::json(
            ['success' => false, 'errors' => ['message' => "Request failed"]],
            ResponseConstants::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    /**
     * Method not allowed Response
     *
     * @return mixed
     */
    public static function methodNotAllowed()
    {
        return Response::json(
            ['success' => false, 'errors' => ['message' => 'Method not allowed']],
            ResponseConstants::HTTP_METHOD_NOT_ALLOWED
        );
    }
}
