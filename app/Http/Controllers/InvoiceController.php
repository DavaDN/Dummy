<?php

namespace App\Http\Controllers;

use App\Models\Invoice;

class InvoiceController extends BaseController
{
    public function __construct(Invoice $invoice)
    {
        $this->model = $invoice;
    }
}
