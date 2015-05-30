<?php
namespace App\Shell;

use Cake\Console\Shell;

/**
 * Export shell command.
 */
class ExportShell extends Shell
{

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main() {
        $countries = $this->loadModel('Countries');
        $results = $countries
            ->find()
            ->contain(['OfficialLanguages'])
            ->all();
		$first = collection(array_keys($results->first()->toArray()))
		->reject(function ($t) {
            return $t === 'official_languages';
        })
        ->toList();
        $official = array_keys($results->first()->official_languages[0]->toArray());
        $titles = array_merge($first, $official);

        $file = new \SplFileObject(TMP . 'countries.csv', 'w+');
        $file->fputcsv($titles);
		$results = $results->reject(function ($country) {
			return empty($country->official_languages);
		});
        foreach ($results as $country) {
			$file->fputcsv(
				$country->extract($first) +
				$country->official_languages[0]->extract($official)
			);
        }
    }
}
