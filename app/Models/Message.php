<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name',
        'email', 
        'message',
        'status',
        'admin_reply',
        'replied_at',
        'testimonial_status'
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    /**
     * Check if message is approved for testimonial
     */
    public function isApprovedForTestimonial()
    {
        return $this->testimonial_status === 'approved';
    }

    /**
     * Get testimonial status badge class
     */
    public function getTestimonialStatusBadgeClass()
    {
        switch ($this->testimonial_status) {
            case 'approved':
                return 'bg-success';
            case 'rejected':
                return 'bg-danger';
            default:
                return 'bg-warning';
        }
    }

    /**
     * Get testimonial status text
     */
    public function getTestimonialStatusText()
    {
        switch ($this->testimonial_status) {
            case 'approved':
                return 'Disetujui';
            case 'rejected':
                return 'Ditolak';
            default:
                return 'Menunggu';
        }
    }
}
