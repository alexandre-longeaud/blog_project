<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class ArticleService
{
    public function __construct(
        private RequestStack $requestStack,
        private ArticleRepository $articleRepo,
        private PaginatorInterface $paginator,
        private OptionService $optionService
    ) {

    }

    public function getPaginatedArticles(?Category $category = null)
    {
        $request = $this->requestStack->getMainRequest();
        $page = $request->query->getInt('page', 1);
        $limit = $this->optionService->getValue('blog_articles_limit');

        $articlesQuery = $this->articleRepo->findForPaginator($category);

        return $this->paginator->paginate($articlesQuery, $page, $limit);
    }
}