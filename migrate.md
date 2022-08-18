# migrate 常用命令

## 创建迁移
## 插入seed数据  
### php artisan db:seed  [--class=名字]
### 重新迁移数据库并 插入表数据
php .\artisan migrate:fresh  --seeder=InitSeeder

#### 例如  php artisan db:seed --class=InitSeeder


### 1.1 适用场景



插入用户id
$form->hidden('super_customer_id')->default(\Admin::user()->id);

插入迁移表
php .\artisan make:migration create_mould_generation_process_template
