<?php

namespace App\Http\Controllers\Pages;

use Analytics;
use Spatie\Analytics\Period;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    const NUMBER_OF_PERIOD_DAYS = 14;
    const ZEFFER_2018_PAGE = '/offers/zeffer-2018';
    const ZEFFER_PRODUCT_NAME = 'Zeffer Cider';
    const TOTAL_FOR_ALL_RESULTS_INDEX = 'totalsForAllResults';

    /**
     * Find the information based on the entered information
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function find(Request $request)
    {
        if (!empty($request)) {
            $result = $this->getResult($request->get('pageName'), $request->get('productName'));
        } else {
            $result = false;
        }
        return view(
            'pages.dashboard',
            ['result' => $result]
        );
    }

    /**
     * Get the results of the entered information
     *
     * @param string|null $pageName
     * @param string|null $productName
     * @param Period|null $period
     *
     * @return array
     */
    private function getResult(string $pageName = null, string $productName = null, Period $period = null)
    {
        $usersMetric = 'ga:users';
        $revenueMetric = 'ga:itemRevenue';

        $pageName = $pageName ?? self::ZEFFER_2018_PAGE;
        $productName = $productName ?? self::ZEFFER_PRODUCT_NAME;
        $period = $period ??  Period::days(self::NUMBER_OF_PERIOD_DAYS);


        //format for displaying revenue
        setlocale(LC_MONETARY, 'en_US');
        return [
            'startDate' => date_format($period->startDate, 'Y-m-d'),
            'endDate' => date_format($period->endDate, 'Y-m-d'),
            'pageName' => $pageName,
            'productName' => $productName,
            'numberOfUsersView' => $this->getNumberOfUsersView(
                $usersMetric,
                $pageName,
                $period
            )[self::TOTAL_FOR_ALL_RESULTS_INDEX][$usersMetric],
            'numberOfLoggedInUsersView' => $this->getNumberOfLoggedInUsersView(
                $usersMetric,
                $pageName,
                $period
            )[self::TOTAL_FOR_ALL_RESULTS_INDEX][$usersMetric],
            'revenue' => money_format(
                '%(#10n',
                $this->getRevenue(
                    $revenueMetric,
                    $productName,
                    $period
                )[self::TOTAL_FOR_ALL_RESULTS_INDEX][$revenueMetric]
            )
        ];
    }

    /**
     * Get the number of users that viewed a specific page over a period of time
     *
     * @var     string    $usersMetric
     * @var     string    $pageName
     * @var     Period    $period
     *
     * @return  int
     */
    private function getNumberOfUsersView(string $usersMetric, string $pageName, Period $period)
    {
        return Analytics::performQuery(
            $period,
            $usersMetric,
            [
                'dimensions' => 'ga:pagePath',
                'filters' => 'ga:pagePath==' . $pageName
            ]
        );
    }

    /**
     * Get the number of users with an account that viewed a page over a period of time
     *
     * @var     string    $usersMetric
     * @var     string    $pageName
     * @var     Period    $period
     *
     * @return  int
     */
    private function getNumberOfLoggedInUsersView(string $usersMetric, string $pageName, Period $period)
    {
        return Analytics::performQuery(
            $period,
            $usersMetric,
            [
                //dimension1 is the custom dimension for userID
                'dimensions' => 'ga:pagePath, ga:dimension1',
                'filters' => 'ga:pagePath==' . $pageName
            ]
        );
    }

    /**
     * Get the amount of revenue over a period of time
     *
     * @var     string    $revenueMetric
     * @var     string    $productName
     * @var     Period    $period
     *
     * @return  int
     */
    private function getRevenue(string $revenueMetric, string $productName, Period $period)
    {
        return Analytics::performQuery(
            $period,
            $revenueMetric,
            [
                'dimensions' => 'ga:productName',
                'filters' => 'ga:productName==' . $productName
            ]
        );
    }
}
