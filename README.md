# gs-demo-dog

[Dog API](https://dog.ceo/dog-api/) の画像を表示する WordPress プラグインのサンプルです。

## ショートコード

下記のショートコードを記述すると犬の画像が表示されます。

```
[gs-dogs]
```

`breed`（犬種。デフォルト：`shiba`）、`count`（表示件数。デフォルト：`1`）属性を指定することができます。

```
[gs-dogs breed=beagle count=5]
```

`breed` に指定できる値は [Breeds list](https://dog.ceo/dog-api/breeds-list) を参照ください。
