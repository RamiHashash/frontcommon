<?php

namespace OlaHub\UserPortal\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use Log;

class OlaHubAuthController extends BaseController {

    protected $requestData;
    protected $requestFilter;

    public function __construct(Request $request) {
        if (env('REQUEST_TYPE') == 'postMan') {
            $req = $request->all();
            $this->requestData = isset($req['data']) ? $req['data'] : [];
            $this->requestFilter = isset($req['filter']) ? $req['filter'] : [];
        } else {
            $this->requestData = $request->json('data');
            $this->requestFilter = $request->json('filter');
        }
    }

    /**
     * Get all stores by filters and pagination
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @return Response
     */
    public function getFilterPagination() {
        $return = $this->service->getPaginationCeriatria();
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 200);
    }

    /**
     * Get all stores by filters
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @return Response
     */
    public function getFilter() {
        $return = $this->service->getAllCeriatria();
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 200);
    }

    /**
     * Get all stores pagination
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @return Response
     */
    public function getAllPagination() {
        $return = $this->service->getPagination();
        if (array_key_exists('error', $return)) {
            Log::info('error: '.$return['msg']);
            return response($return, 200);
        }
        return response($return, 200);
    }

    /**
     * Get all stores
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @return Response
     */
    public function getAll() {
        $return = $this->service->getAll();
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response(json_encode($return), 200);
    }

    /**
     * Show one store by specific data
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @return Response
     */
    public function getOneFilter() {
        $return = $this->service->getOneByFilter();
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 200);
    }

    /**
     * Show one store by ID
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @param integer $id Store ID
     * @return Response
     */
    public function getOneId($id) {
        $return = $this->service->getOneById($id);
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 200);
    }

    /**
     * Save new data in database
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @return Response
     */
    public function createNewEntry() {
        $return = $this->service->saveNewData();
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 200);
    }

    /**
     * Update data for exist row
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @param integar $id Specific row ID
     * @return Response
     */
    public function updateExsitEntryById($id) {
        $return = $this->service->updateById($id);
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 200);
    }

    /**
     * Update data for exist data using ceriatria 
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @return Response
     */
    public function updateExsitEntryByFilter() {
        $return = $this->service->updateByFilter();
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 200);
    }

    /**
     * Publish or Unpublish exist data using ceriatria
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @return Response
     */
    public function updateStatusForEntryByFilter($status) {
        $return = $this->service->updateByFilter($status);
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 200);
    }

    /**
     * Publish or Unpublish exist data using ceriatria
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @param integar $id Specific row ID
     * @return Response
     */
    public function updateStatusForEntryById($id, $status) {
        $return = $this->service->updateById($id, $status);
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 200);
    }

    /**
     * Delete data for exist row
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @param integar $id Specific row ID
     * @return Response
     */
    public function deleteExsitEntryById($id) {
        $return = $this->service->deleteById($id);
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 410);
    }

    /**
     * Delete data for exist data using ceriatria 
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @return Response
     */
    public function deleteExsitEntryByFilter() {
        $return = $this->service->deleteByFilter();
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 410);
    }

    /**
     * Delete data for exist row
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @param integar $id Specific row ID
     * @return Response
     */
    public function restoreDeletedEntryById($id) {
        $return = $this->service->restoreById($id);
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 200);
    }

    /**
     * Delete data for exist data using ceriatria 
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @return Response
     */
    public function restoreDeletedEntryByFilter() {
        $return = $this->service->restoreByFilter();
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 200);
    }
    
    /**
     * Check if specific ceriatria has data or no (check Unique fields) 
     *
     * @param  Request  $request constant of Illuminate\Http\Request
     * @return Response
     */
    public function getCheckDataUnique() {
        $return = $this->service->checkUniqueData();
        if (array_key_exists('error', $return)) {
            Log::info('error: '.json_encode($return['msg']));
            return response($return, 200);
        }
        return response($return, 200);
    }

}
