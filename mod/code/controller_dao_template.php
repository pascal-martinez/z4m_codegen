<?php
/**
 * App Controller class.
 * Code Generated by the Code Generator module of ZnetDK 4 Mobile.
 */
namespace __CONTROLLER_NAMESPACE__;
class __CONTROLLER_CLASS_NAME__ extends \AppController {
    static public function isActionAllowed($action) {
        $status = parent::isActionAllowed($action);
        if ($status === FALSE) {
            return FALSE;
        }
        $menuItem = '{{VIEW_NAME}}';
        return CFG_AUTHENT_REQUIRED === TRUE
            ? \controller\Users::hasMenuItem($menuItem) // User has right on menu item
            : \MenuManager::getMenuItem($menuItem) !== NULL; // Menu item declared in 'menu.php'
    }
    static protected function action_all() {
        $request = new \Request();
        $first = $request->first;
        $count = $request->count;
        $sortfield = $request->sortfield;
        $sortorder = $request->sortorder;
        $sortCriteria = isset($sortfield) && isset($sortorder) 
                ? $sortfield . ($sortorder == -1 ? ' DESC' : '') : 'id DESC';
        $rows = [];
        // Success response returned to the main controller
        $response = new \Response();
        $response->total = self::getRows($first, $count, $request->keyword, $sortCriteria, $rows);
        $response->rows = $rows;
        $response->success = TRUE;
        return $response;
    }
    static protected function getRows($first, $count, $searchCriteria, $sortCriteria, &$rows) {
        $dao = new __DAO_CLASS__;
        if ($searchCriteria !== NULL) {
            $dao->setKeywordAsFilter($searchCriteria, '{{SEARCH_COLUMN}}');
        }
        $dao->setSortCriteria($sortCriteria);
        $total = $dao->getCount();
        if (!is_null($first) && !is_null($count)) {
            $dao->setLimit($first, $count);
        }
        while ($row = $dao->getResult()) {
            $rows[] = $row;
        }
        return $total;
    }
    static protected function action_detail() {
        $request = new \Request();
        $dao = new __DAO_CLASS__;
        $detail = $dao->getById($request->id);
        $response = new \Response();
        if (is_array($detail)) {
            $response->setResponse($detail);
        } else {
            $response->setWarningMessage(NULL, LC_MSG_INF_NO_RESULT_FOUND);
        }
        return $response;
    }
    static protected function action_store() {
        $response = new \Response();
        $validator = new __VALIDATOR_CLASS__;
        $validator->setCheckingMissingValues();
        if (!$validator->validate()) {
            $response->setFailedMessage(NULL, $validator->getErrorMessage(),
                $validator->getErrorVariable());
            return $response;
        }
        $request = new \Request();
        $formData = $request->getValuesAsMap(__PROPERTY_NAMES__);
        $dao = new __DAO_CLASS__;
        $rowId = $dao->store($formData);
        $response->setSuccessMessage(NULL, LC_MSG_INF_SAVE_RECORD . " ID={$rowId}.");
        return $response;
    }
    static protected function action_suggestions() {
        $request = new \Request();
        $response = new \Response();
        $response->setResponse(self::getFoundKeywords($request->query,
                '{{SEARCH_COLUMN}}', 10));
        return $response;
    }
    static protected function getFoundKeywords($query, $searchInColumn, $count) {
        $dao = new __DAO_CLASS__;
        $suggestions = array();
        $dao->setFilterForSuggestions($query, $searchInColumn);
        $dao->setSortCriteria($searchInColumn);        
        $dao->setLimit(0, $count);
        while ($row = $dao->getResult()) {
            if (key_exists('id', $row)) {
                $row['value'] = $row['id'];
            }
            if (key_exists($searchInColumn, $row)) {
                $row['label'] = $row[$searchInColumn];
                $suggestions[] = $row;
            }
        }
        return $suggestions;
    }
    static protected function action_remove() {
        $request = new \Request();
        $dao = new __DAO_CLASS__;
        $rowFound = $dao->getById($request->id);
        $response = new \Response();
        if (is_array($rowFound)) {
            $dao->remove($rowFound['id']);
            $response->setSuccessMessage(NULL, LC_MSG_INF_REMOVE_RECORD . " ID={$rowFound['id']}.");
        } else {
            $response->setFailedMessage(NULL, LC_MSG_INF_NO_RESULT_FOUND .  " ID={$request->id}.");
        }
        return $response;
    }
}