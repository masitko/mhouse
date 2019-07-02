<?php

namespace LaravelEnso\Schools\app\Models;

use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\TrackWho\app\Traits\UpdatedBy;
use LaravelEnso\Discussions\app\Traits\Discussable;
use LaravelEnso\ActivityLog\app\Traits\LogsActivity;
use LaravelEnso\CommentsManager\app\Traits\Commentable;
use LaravelEnso\AddressesManager\app\Traits\Addressable;
use LaravelEnso\DocumentsManager\app\Traits\Documentable;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

use LaravelEnso\FileManager\app\Traits\HasFile;
use LaravelEnso\FileManager\app\Contracts\Attachable;
use LaravelEnso\FileManager\app\Classes\FileManager;

class School extends Model implements Attachable
{
    use Addressable, Commentable, CreatedBy, Discussable,
        Documentable, LogsActivity, UpdatedBy;

// ========== LOGO START ============       
    use HasFile;
    const ImageWidth = 250;
    const ImageHeight = 250;
    protected $optimizeImages = true;
    protected $resizeImages = [self::ImageWidth, self::ImageHeight];
    protected $mimeTypes = ['image/png', 'image/jpg', 'image/jpeg'];
// ========== LOGO END ============       

    protected $guarded = ['logo'];

    protected $loggableLabel = 'name';

    protected $loggable = ['name', 'email', 'phone', 'dfe'];

    public function mandatary()
    {
        return $this->belongsTo(Person::class, 'mandatary_id');
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function isTenant()
    {
        return false;
    }

    public function delete()
    {
        try {
            parent::delete();
        } catch (\Exception $e) {
            throw new ConflictHttpException(__(
                'The school has activity in the system and cannot be deleted'
            ));
        }

        return ['message' => 'The school was successfully deleted'];
    }

// ========== LOGO START ============       
    // public function store(UploadedFile $file)
    // {
    //     $school = null;

    //     \DB::transaction(function () use (&$school, $file) {
    //         $this->delete();

    //         $school = School::create(['user_id' => auth()->user()->id]);

    //         $school->upload($file);
    //     });

    //     return $school;
    // }

    public function logoUpload(UploadedFile $file) {
      (new FileManager($this))->delete();
      $this->upload($file);
    }

    public function getLogo()
    {
        return $this->download();
    }

    public function folder()
    {
        return config('enso.config.paths.logos');
    }
// ========== LOGO END ============       

}
