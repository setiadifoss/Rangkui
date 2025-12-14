<?php

$routes->group('report', ['namespace' => 'App\Modules\Reporting\Controllers'], function ($routes) {
    /**
     * Satistic Collection Routes
     */
    $routes->get('stats-collection', 'ReportingController::index');
    $routes->get('stats-collection/stats', 'ReportingController::stats');

    /**
     * Member Report
     */
    $routes->get('membership', 'ReportMemberController::member');
    $routes->get('membership/stats', 'ReportMemberController::stats');

    /**
     * Download Counter
     */
    $routes->get('download-counter', 'DownloadCounterController::index');
    $routes->get('download-counter/stats', 'DownloadCounterController::stats');

    /**
     * Recapitulation Report
     */
    $routes->get('recap', 'ReportRecapController::recap');
    $routes->post('recap/filter', 'ReportRecapController::filter');

    /**
     * Title List Report
     */
    $routes->get('titles', 'ReportTitleController::titles');
    $routes->post('titles/filter', 'ReportTitleController::filter');

    /**
     * Report List Member
     */
    $routes->get('list-member', 'ReportMemberController::list');

    /**
     * Report Contributors
     */
    $routes->get('contributors', 'ReportContributorsController::contributors');
    $routes->post('contributors/filter', 'ReportContributorsController::filter');

    /**
     * Report Staff Activity
     */
    $routes->get('staff-activity', 'ReportStafActController::staff_act');
    $routes->post('staff-activity/filter', 'ReportStafActController::filter');

    /**
     * Visitor List Report
     */
    $routes->get('visitor', 'VisitorController::index');
    $routes->post('visitor/filter', 'VisitorController::filter');

    /**
     * Visualize Diagram
     */
    $routes->get('vizd', 'VisualizeDiagramController::index');
    $routes->post('vizd/mindmap', 'VisualizeDiagramController::showMm');
});
