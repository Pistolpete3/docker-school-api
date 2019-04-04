<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Prepare generic csv for streamed download
     *
     * @param array $data
     * @param array|null $columns
     * @param string $filename
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    protected function prepareCSVDownload(
        array $data,
        array $columns = null,
        string $filename = 'filename.csv'
    ): StreamedResponse
    {
        $headers = [
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=galleries.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        ];

        $csvCallback = function () use ($data, $columns) {
            $handle = fopen('php://output', 'w');

            if (true == $columns) {
                fputcsv($handle, array_map('ucfirst', $columns));
            }

            foreach ($data as $item) {
                fputcsv($handle, $item);
            }

            fclose($handle);
        };

        return response()->streamDownload($csvCallback, $filename, $headers);
    }
}
