Краткая инструкция по установке/настройке markup для нового проекта.

#### Что используется:

*   [npm](https://docs.npmjs.com/getting-started/what-is-npm)
*   [Babel](https://babeljs.io/)
*   [SASS](http://sass-lang.com/) (с синтаксисом SCSS) + [bourbon](http://bourbon.io/)
*   [PostCSS](http://postcss.org/)
*   [Pug](https://pugjs.org/) язык разметки + шаблонизатор
*   [ESLint](http://eslint.org/) линтер для JS

Markup находится в _git_ репозитории [тут](https://git.ebola.com.ua/internal/markup-template-webpack).

#### Начало:

Клонируем его, заходим в папку нового проекта, удаляем файлы _git_ и создаём новые, поскольку у нашего нового проекта будет "своя история":

``` shell
$ git clone https://git.ebola.com.ua/internal/markup-template-webpack.git <имя нового проекта>
$ cd <имя нового проекта>
$ rm -rf .git && git init
```

Для сборки проекта понадобится _npm_. Следуем [инструкции по установке _nodejs_](https://nodejs.org/en/download/package-manager/), поскольку _npm_ является частью _nodejs_. И устанавливаем с помощью _npm_ всё что нам необходимо для сборки:

``` shell
$ cd markup
$ npm install
```
_* - необязательно_

#### Конфигурация:

Конфигурационные файлы находятся в папке **markup**:

*   [package.json](https://docs.npmjs.com/files/package.json) - список инструментов для сборки проекта и информация о проекте
*   [.babelrc](http://babeljs.io/docs/usage/options/) - конфигурационный файл JS-трансплитера _Babel_
*   [.browserslistrc](https://github.com/browserslist/browserslist) - конфигурационный файл _browserslist_ (его используют _babel-env_ и _autoprefixer_)
*   [.eslintrc.json](http://eslint.org/docs/user-guide/configuring) - конфигурационный файл линтера _ESLint_
*   [.eslintignore](http://eslint.org/docs/user-guide/configuring#ignoring-files-and-directories) - список файлов/папок которые _ESLint_ не должен проверять
*   [.editorconfig](http://editorconfig.org/) - конфигурационный файл для редакторов/IDE _EditorConfig_
*   [.gitignore](https://git-scm.com/docs/gitignore) - список файлов/папок которые _git_ не должен добавлять в репозиторий

Все исходники хранятся в папке **markup/src** и компилируются с помощью _webpack_ в папку **markup/build**. Файлы "входа" для CSS/JS:

*   **markup/src/scss/application.scss**, по законам импорта [SASS](http://sass-lang.com/documentation/file.SASS_REFERENCE.html#import) (если используются алиасы _webpack_, то добавлять префикс `~` к пути файла)
*   **markup/src/js/app/application.js**, по законам импорта JS ES6
*   **markup/src/js/vendor/vendor.js**, по законам импорта JS ES6

_webpack_ алиасы (если используются в \*.{scss, css} файлах, то добавлять префикс `~` к пути файла):
*   `Vendors` >>> **src/vendor/**
*   `Scripts` >>> **src/js/**
*   `Styles` >>> **src/sass/**
*   `Templates` >>> **src/pug/**
*   `Images` >>> **src/img/**

#### Рабочий процесс:
При запуске проекта одним из _npm_ скриптов для запуска/сборки происходит следующее:
*   JS файлы проверяются линтером _ESLint_ на соответствие [код-стайлу](http://google.github.io/styleguide/javascriptguide.xml)
*   собираются с помощью _Babel_ \*.js файлы в папку **build** (файлы "входа": **src/js/app/application.js**, **src/js/vendor/vendor.js**; "выхода": **build/assets/js/application.js**, **build/assets/js/vendor.js**)
*   собираются с помощью _SASS_ \*.scss(\*.css) файлы перечисленные в **src/scss/application.scss** в файл **build/assets/css/application.css**
*   собираются с помощью _Pug_ \*.html файлы в папку **build**
*   собираются файлы шрифтов в папку **build/assets/fonts**
*   собираются файлы картинок в папку **build/assets/img**

Список скриптов _npm_:

*   `npm start` - запустить проект в режиме разработки, [веб-сервером на 9000м порту](http://localhost:9000/) (сборка не будет записываться на диск, и будет находится в оперативной памяти; особенность [_webpack-dev-server_](https://webpack.js.org/configuration/dev-server/))
*   `npm run build:dev` - собрать проект для development режима
*   `npm run watch:dev` - собрать проект для development режима, и следить за изменениями в исходных файлах
*   `npm run build:prod` - собрать проект для production режима
*   `npm run watch:prod` - собрать проект для production режима, и следить за изменениями в исходных файлах

#### P.S. jQuery по-умолчанию выключен
Если нужен:
1. `config/webpack.default.js`:
    ```diff
    -  'dom4',
    -  'delegated-events',
    -  // 'jquery',

    +  // 'dom4',
    +  // 'delegated-events',
    +  'jquery',
    ```
2. `src/js/app/application.js`:
    ```diff
    -  import Main from './Main';
    -  // import MainJquery from './Main.jquery';

    +  // import Main from './Main';
    +  import MainJquery from './Main.jquery';
    ```

    ```diff
    - new Main();
    -
    - // window.jQuery = jQuery;
    - // window.$ = jQuery;
    - // new MainJquery();
    -
    - // export {
    - //   jQuery,
    - // };

    + // new Main();
    +
    + window.jQuery = jQuery;
    + window.$ = jQuery;
    + new MainJquery();
    +
    + export {
    +   jQuery,
    + };
    ```
