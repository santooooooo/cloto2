#!/bin/bash
export PATH="/usr/local/bin:/bin:/usr/bin:/usr/local/sbin:/usr/sbin:/sbin"
export LANG=C

# rootで実行されていることを確認
if [ "`whoami`" != "root" ] ; then
  echo -e "\n\nsudoで実行してください。\n\n"
  exit 1
fi



# システムの停止
echo -e "\n\nシステムを停止します。"
php artisan system:down


# データのバックアップ
echo -e "\n\n--------------------------------------------------"
echo -e "\n\nデータのバックアップ中．．．\n"
sh daily-backup.sh
echo -e "\nデータのバックアップを終了しました。"


# 更新の取得
echo -e "\n\n--------------------------------------------------\n\n"
git reset --hard
git pull origin master
git log -1


# 書き込み権限の付与
chmod -R 777 ./storage
chmod -R 777 ./bootstrap/cache
echo -e "\n\n--------------------------------------------------\n\n"


# コンパイル
echo -e "コンパイル中．．．\n"
npm run production


# システムの復旧
php artisan up
echo -e "\n\n--------------------------------------------------"
echo -e "\n\nシステムを復旧しました。\n\n"



exit 0
