#!/bin/bash
export PATH="/usr/local/bin:/bin:/usr/bin:/usr/local/sbin:/usr/sbin:/sbin"
export LANG=C


# rootで実行されていることを確認
if [ "`whoami`" != "root" ] ; then
  echo -e "\n\nsudoで実行してください。\n\n"
  exit 1
fi


# システムの停止
echo -e "システムを停止します。\n"
php artisan system:down

# データのバックアップ
echo -e "データのバックアップ中．．．\n\n"
sh daily-backup.sh
echo -e "データのバックアップを終了しました。\n\n"

# 更新の取得
git fetch origin master

# 書き込み権限の付与
chmod -R 777 ./storage
chmod -R 777 ./bootstrap/cache

# コンパイル
echo -e "----------------------------------------\n\n"
echo -e "コンパイル中．．．\n"
npm run production

# システムの復旧
php artisan up
echo -e "システムを復旧しました。\n"


exit 0
