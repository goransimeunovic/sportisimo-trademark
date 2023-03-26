<?php

declare(strict_types=1);

namespace App\Model;

use Nette;

final class TrademarksModel
{
	public function __construct(
		private Nette\Database\Explorer $database,
	) {
	}


    /**
     * Update trademark
     *
     * @param $id
     * @param $value
     * @return void
     */
    public function updateTrademarks($id,$value): void
    {
        $this->database->table('trademarks')
            ->where('id',$id)
            ->update([
                'name'=>$value['name']
            ]);
    }

    public function insertTrademarks($values): bool
    {
        //select * from users where lower(first_name) like '%al%';
        $trademark = $this->database->table('trademarks')
            ->where('LOWER(name) LIKE ?', strtolower($values['name']))->count();

        if ($trademark == 0) {
            $this->database->table('trademarks')->insert([
                [
                    'name' => $values['name']
                ]
            ]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete record
     *
     * @param $id
     * @return void
     */
    public function deleteRecord($id): void
    {
        $this->database->table('trademarks')
            ->where('id',$id)
            ->delete();
    }
}