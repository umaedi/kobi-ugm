<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api as Controller;
use Illuminate\Http\Request;
use App\Repositories\DocumentRepository;

class DocumentController extends Controller
{
    private $documentRepository;
    public function __construct(DocumentRepository $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    public function getByCategory(Request $request, $category_id)
    {
        if ($request->ajax()) {
            $documents = $this->documentRepository->getByCategory($category_id);
            return $documents;
        }
    }
}
