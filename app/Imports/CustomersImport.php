<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CustomersImport implements ToModel,WithHeadingRow,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'customer_id' => $row['customer_id'],
            'name'        => $row['name'],
            'email'       => $row['email'],
            'password'    => $row['password'],
            // 'password'    => bcrypt($row['password'] ?? 'defaultpassword'), 
            'mobile'      => $row['mobile'],
            'amount'      => $row['amount'] ?? 0,
            'created_at'  => \Carbon\Carbon::parse($row['created_at']),
            'updated_at'  => \Carbon\Carbon::parse($row['updated_at']),
        ]);
    }

    public function rules(): array
    {
        return [
            'email' => 'unique:customers,email',
        ];
    }
}
