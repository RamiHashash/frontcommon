<?php

namespace OlaHub\UserPortal\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;


class OlaHubAuthController extends BaseController {

    protected $requestData;
    protected $requestFilter;


    /**
     * Get all stores by filters and pagination
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @return Response
     */
    public function getAllPagination(Request $request) {
        if (env('REQUEST_TYPE') == 'postMan') {
            $req = $request->all();
            $this->requestData = isset($req['data']) ? $req['data'] : [];
            $this->requestFilter = isset($req['filter']) ? $req['filter'] : [];
        } else {
            $this->requestData = $request->json('data');
            $this->requestFilter = $request->json('filter');
        }
        dd($this->requestData);
        $return = $this->service->getPaginationCeriatria();
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 200);
    }
}
