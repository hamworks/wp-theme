# WP with docker


## getting started

* Docker Compose が必要です。

### Start Development

```bash
npm install
docker-compose up -d
npm run start
```

* note: plugin は composer で管理してます。


### Stop

```bash
docker-compose stop
```

### Destroy docker images.

```bash
docker-compose down
docker volume rm wp_wordpress
docker volume rm wp_db-data
```

wp_ は、ディレクトリによってかわります。[docker-compose コマンド概要 — Docker-docs-ja 17.06.Beta ドキュメント](http://docs.docker.jp/compose/reference/overview.html) を参照して下さい。

## Commands and Shell Scripts.

### npm

* `npm start` : BrowerSync / Webpack / postcss が立ち上がりファイルを監視します。
* `npm run build`  : CSS と JS をビルドします。
* `npm run production`: production ビルドを作成します。

### sh

#### Export SQL

`wp-content/sql` に SQL ファイルをエクスポートします。

```
$ docker-compose run --rm cli bash /home/www-data/app/sh/export-sql.sh  
```


## Spec

### CSS

* [postcss-preset-env](https://preset-env.cssdb.org/) と PostCSS です。

### JS

* React + Babel してます。

## config

### .env

* `WP_PORT`: WordPress Port. default: 5678.
* `WP_VERSION`: WordPress のバージョン
* `WP_THEME`: WordPress のテーマ

### WordPress Accounts

* `WP_ADMIN_USER`: admin
* `WP_ADMIN_PASS`:password

### WordPress Core Update Command

```
docker-compose run --rm cli wp core update --version=5.2.1 --locale=ja --force
```
