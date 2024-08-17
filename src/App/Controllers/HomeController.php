<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\TransactionService;


class HomeController
{

    // private  TemplateEngine $view;

    public function __construct(private TemplateEngine $view, private TransactionService $transactionService)
    {
        // $this->view = new TemplateEngine(Paths::VIEW);
    }

    public function home()
    {
        $page = $_GET['p'] ?? 1;
        // ^ PAGE NUMBER
        $page = (int) $page;
        $length = 3;
        $offset = ($page - 1) * $length;
        $searchTerm = $_GET['s'] ?? NULL;

        [$transactions, $count] = $this->transactionService->getUserTransactions($length, $offset);

        $lastPage = ceil($count / $length);
        $pages = $lastPage ? range(1, $lastPage) : [];
        $pageLinks = array_map(
            fn($pageNum) => http_build_query([
                'p' => $pageNum,
                's' => $searchTerm
            ]),
            $pages

        );

        // $secret = "Hussain";
        echo $this->view->render("index.php", [
            'transactions' => $transactions,
            'currentPage' => $page,
            'previousPageQuery' => http_build_query([
                'p' => $page - 1,
                's' => $searchTerm
            ]),
            'lastPage' => $lastPage,
            'nextPageQuery'  => http_build_query([
                'p' => $page + 1,
                's' => $searchTerm
            ]),
            'pageLinks' => $pageLinks,
            'searchTerm' => $searchTerm
        ]);
    }
}

// $data array as a variable is used as a parameter from the render method
        // the included files has access to the parameters data which not in case of $secret as it's function scoped