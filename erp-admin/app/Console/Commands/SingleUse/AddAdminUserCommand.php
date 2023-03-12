<?php
declare(strict_types=1);

namespace App\Console\Commands\SingleUse;

use Illuminate\Console\Command;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Exception;
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
    protected $signature = 'command:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '管理者登録';
    private $error ;
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
        $this->info('登録作業を始めます');

        $login_id = $this->ask('login_idを入力してください。');
        $password = $this->secret('passwordを入力してください。');

        $params = [
            'loginId'  => $login_id,
            'password'  => $password
        ];

         if($this->confirm('この内容で実行してよろしいですか?')) {
          if($this->validate($params)){
            $this->transaction($params);
          }else{
            $this->info('入力エラーです。');
            $this->info($this->error);
          }
    }else{
        $this->info('キャンセルとなります。');
    } echo '登録終了';
}

    private function validate(array $params)
    {
        if (empty($params['loginId']) || empty($params['password'])) {
            $this->error = 'ログインIDまたはパスワードが入力されていません!';
            return false;
        }
        if (Admin::where('login_id', $params['loginId'])->exists()) {
            $this->error = 'すでに使用されているログインIDです!';
            return false;
        }
        return true;
    }

    private function transaction(array $params)
    {
        try {
            DB::beginTransaction();
            $this->create($params);
            DB::commit();
            $this->info($params['loginId'].'を登録しました。');
        } catch (Exception $e) {
            DB::rollBack();
            $this->error('エラーが発生しました。');
            $this->error($e->getMessage());
        }
    }

    private function create(array $params)
    {
        $admin = new Admin();
        Admin::create([
            'login_id' => $params['loginId'],
            'password' => \Hash::make($params['password'])
        ]);
    }
}