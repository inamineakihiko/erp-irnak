<?php
declare(strict_types=1);

namespace App\Console\Commands\SingleUse;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
/**
 * 管理者登録
 *
 * @property string $signature
 * @property string $description
 */
class AddAdminUserCommand extends Command
{
    /** @var string コマンド */
    protected $signature = 'command:admin_register';
    /** @var string コマンド詳細 */
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
     * @return void
     */
    public function handle()
    {
      $name = $this->ask('登録するlogin_id(半角英数字のみ)を入力してください。');
      $password = $this->secret('登録するpasswordを入力してください。');

      if (preg_match("/^[a-zA-Z0-9]{5,10}+$/",$name)) {
        $this->info("login_id : $name");
      } else {
        $this->info("login_idは半角英数字かつ5文字以上10文字以内で入力してください。");
        return 0;
      }

      if (preg_match("/^[a-zA-Z0-9]{6,10}+$/",$password)) {
        $this->info("password : $password");
      } else {
        $this->info("passwordは半角英数字かつ6文字以上10文字以内で入力してください");
        return 0;
      }

      if ($this->confirm('この内容で登録してもよろしいでしょうか?')) {
      $isExist = DB::table('admins')->where('login_id', '=', $name)->first();
      if($isExist){
        $this->info('既に登録されているlogin_idですので他のlogin_idで登録してください。');
        return 0;
        } else {
          DB::table('admins')->insert([
            'uuid'  => Uuid::uuid4()->toString(),
            'login_id'   => $name,
            'password' =>  Hash::make($password),
            'created_at' => Carbon::now('Asia/Tokyo'),
            'updated_at' => Carbon::now('Asia/Tokyo'),
          ]);
          $this->table(
            ['login_id','password'],
            [[$name,$password]]
        );
      }
    } else {
      $this->error('もう一度最初からやり直してください');
    }
  }
}
