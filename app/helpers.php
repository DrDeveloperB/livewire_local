<?php

if (!function_exists('getSqlWithBindings')) {
    function getSqlWithBindings($query)
    {
        foreach ($query as $k => $v) {
            $query[$k]['bindingQuery'] = vsprintf(
                str_replace('?', '%s', $v['query']),    // $query->toSql() , $query['query']
                collect($v['bindings'])      // $query->getBindings() , $query['bindings']
                ->map(
                    function ($binding) {
                        return is_numeric($binding) ? $binding : "'{$binding}'";
                    }
                )
                    ->toArray()
            );
        }
        return $query;
    }
}

if (!function_exists('fnPermissionMenu')) {
    /**
     * 메뉴 권한 추출
     * @param array $aPermissionMenu : 메뉴 권한 코드 리스트
     * @param $oCode : 통합권한에서 전달받은 메뉴 권한 객체
     * @return array
     */
    function fnPermissionMenu(array $aPermissionMenu, $oCode)
    {
        $aCode = (array) $oCode;
        if (count($aCode) > 0) {
            foreach ($aCode as $nKey => $oVal) {
                $aVal = (array) $oVal;
                if (isset($aVal['code']) && !empty($aVal['code'])) {
                    array_push($aPermissionMenu, $aVal['code']);
                }

                $aSub = isset($aVal['sub']) ? (array) $aVal['sub'] : array();
                if (count($aSub) > 0) {
                    $aPermissionMenu = fnPermissionMenu($aPermissionMenu, $aSub);
                }
            }
        }

        return $aPermissionMenu;
    }
}
