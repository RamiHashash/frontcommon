<?php

namespace OlaHub\UserPortal\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class OlaHubAuthController extends BaseController {

    protected $requestData;
    protected $requestFilter;

    public function __construct(Request $request) {
        $return = \OlaHub\UserPortal\Helpers\OlaHubCommonHelper::getRequest($request);
        $this->requestData = $return['requestData'];
        $this->requestFilter = $return['requestFilter'];
    }

    /**
     * Get all stores by filters and pagination
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @return Response
     */
    public function getAllPagination() {
        dd("eslam");
        $return = $this->service->getPaginationCeriatria();
        if (array_key_exists('error', $return)) {
            Log::info('error: ' . json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 200);
    }

}
