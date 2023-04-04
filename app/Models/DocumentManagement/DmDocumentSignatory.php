<?php

namespace App\Models\DocumentManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DmDocumentSignatory extends Model
{
    use HasFactory;
    protected $fillable =[
        'document_id',
        'signatory_id',
        'signatory_level',
        'signatory_status',
        'is_active',
        'acknowledgement',
        'signature',
        'comments',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'signatory_id', 'id');
    }
}
