<?php
declare(strict_types=1);

namespace App\Console\Commands\SingleUse;

use Illuminate\Console\Command;
use App\Models\Admin;
use Illuminate\Validation\ValidationException;

/**
 * 管理者登録
 *
 * @property string $signature
 * @property string $description
 */
class AddAdminUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:admin {login_id} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '管理者登録';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     *
     */
    public function handle()
    {

        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->error('validation error!');
            foreach ($e->validator->getMessageBag()->all() as $error) {
                $this->error($error);
            }
            return 0;
        }

        $this->create();
        $login_id = $this->argument('login_id');
        $password = $this->argument('password');
        $this->table(
            ['login_id', 'password'],
            [
                [$login_id,$password]
            ]
        );

        $this->info('登録完了！');
    }
    private function validate()
    {
        \Validator::validate(
            array_filter($this->arguments()),
            [
                'login_id' => 'unique:admins',
            ],
            [
                'login_id.unique' => '既に使われているlogin_idです。'
            ]
        );
    }
    private function create()
    {
        $login_id = $this->argument('login_id');
        $password = $this->argument('password');
        Admin::factory()->create([
            'login_id' => $login_id,
            'password' => \Hash::make($password)
        ]);
    }

}