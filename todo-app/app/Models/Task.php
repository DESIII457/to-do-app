<?php

namespace App\Models;
// Menentukan namespace model agar sesuai dengan struktur proyek
use Illuminate\Database\Eloquent\Model;
use App\Models\TaskList;

class Task extends Model
// Mendefinisikan model Task untuk merepresentasikan tabel tasks dalam database.
{
    protected $fillable = [
        // menentukan kolom yang dapat diisi secara massal (mass assignment).
        'name',
        'description',
        'is_completed',
        // Menyimpan status apakah tugas sudah selesai atau belum.
        'priority',
        'list_id'
        // Merupakan foreign key yang merujuk ke TaskList.
    ];

    protected $guarded = [
        // menentukan kolom yang tidak boleh diisi secara massal.
        'id',
        // Melindungi agar ID tidak dapat diubah secara tidak sengaja.
        'created_at',
        'updated_at'
        // Laravel otomatis mengelola timestamp, jadi tidak perlu diisi manual.
    ];

    const PRIORITIES = [
        'low',
        'medium',
        'high'
    ];

    public function getPriorityClassAttribute() {
        return match($this->attributes['priority']) {
            'low' => 'success',
            'medium' => 'warning',
            'high' => 'danger',
            default => 'secondary'
        };
    }

    public function list() {
        return $this->belongsTo(TaskList::class, 'list_id');
    }
}
