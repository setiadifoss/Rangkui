<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LanguageFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Tentukan bahasa dari session atau query string
        $locale = $request->getLocale();

        // Tentukan path di mana file terjemahan berada
        $localeDir = APPPATH . 'Locale/' . $locale . '/LC_MESSAGES';

        // Setel locale yang diinginkan
        putenv("LC_ALL=$locale");
        setlocale(LC_ALL, $locale);

        // Pilih domain untuk pesan
        bindtextdomain('messages', $localeDir);
        textdomain('messages');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak diperlukan setelahnya
    }
}
