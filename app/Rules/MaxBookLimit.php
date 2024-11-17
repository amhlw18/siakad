<?php

namespace App\Rules;

use App\Models\Peminjaman;
use Illuminate\Contracts\Validation\Rule;

class MaxBookLimit implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Hitung jumlah buku yang sudah dipinjam user
        $status = 0; // Contoh nilai status
        $existingBookCount = Peminjaman::where('user_id',  $this->userId)
            ->where('status', $status)
            ->count();

        // Pastikan bahwa $value adalah array
        if (!is_array($value)) {
            $value = [$value];
        }

        // Tambahkan jumlah buku yang akan dipinjam
        $totalBookCount = $existingBookCount + count($value);

        return $totalBookCount <= 3;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Anda hanya dapat meminjam maksimal 3 buku.';
    }
}
