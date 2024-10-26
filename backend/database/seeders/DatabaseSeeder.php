<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PolicyHolder;
use App\Models\Policy;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create policy holders
        $holders = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'city' => 'New York'
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'city' => 'Los Angeles'
            ],
            [
                'first_name' => 'Bob',
                'last_name' => 'Johnson',
                'city' => 'Chicago'
            ],
            [
                'first_name' => 'Alice',
                'last_name' => 'Brown',
                'city' => 'Houston'
            ],
            [
                'first_name' => 'Mike',
                'last_name' => 'Wilson',
                'city' => 'Phoenix'
            ]
        ];

        foreach ($holders as $holder) {
            PolicyHolder::create($holder);
        }

        // Create multiple policies for each holder
        $policies = [
            [
                'policy_no' => 'POL-001',
                'status' => 'Active',
                'type' => 'Auto',
                'effective_date' => '2024-01-01',
                'expiration_date' => '2024-12-31',
                'policy_holder_id' => 1
            ],
            [
                'policy_no' => 'POL-002',
                'status' => 'Pending',
                'type' => 'Home',
                'effective_date' => '2024-02-01',
                'expiration_date' => '2025-01-31',
                'policy_holder_id' => 1
            ],
            [
                'policy_no' => 'POL-003',
                'status' => 'Active',
                'type' => 'Life',
                'effective_date' => '2024-03-01',
                'expiration_date' => '2025-02-28',
                'policy_holder_id' => 2
            ],
            [
                'policy_no' => 'POL-004',
                'status' => 'Active',
                'type' => 'Auto',
                'effective_date' => '2024-01-15',
                'expiration_date' => '2024-12-31',
                'policy_holder_id' => 2
            ],
            [
                'policy_no' => 'POL-005',
                'status' => 'Cancelled',
                'type' => 'Home',
                'effective_date' => '2024-02-15',
                'expiration_date' => '2025-02-14',
                'policy_holder_id' => 3
            ]
        ];

        foreach ($policies as $policy) {
            Policy::create($policy);
        }
    }
}
