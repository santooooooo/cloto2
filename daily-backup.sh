#!/bin/bash
export PATH="/usr/local/bin:/bin:/usr/bin:/usr/local/sbin:/usr/sbin:/sbin"
export LANG=C


# バックアップ先
BACKUP="/home/admin/backup"
# データベースの一時出力先
SQL="/home/admin/cloto.sql"


RSYNC="rsync $1 -av --delete"

LOG="/var/log/cloto_backup.log"
if [ -f $LOG ]; then
        gzip -f $LOG
fi

# storageのバックアップ
$RSYNC /var/www/html/storage/app/public $BACKUP >> $LOG 2>&1
# データベースのバックアップ
mysqldump -u root cloto > $SQL
$RSYNC $SQL $BACKUP >> $LOG 2>&1
rm -f $SQL


exit 0
