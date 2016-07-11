# Echonest API

[![Latest Stable Version](https://poser.pugx.org/edwindayot/echonest/v/stable)](https://packagist.org/packages/edwindayot/echonest)
[![Total Downloads](https://poser.pugx.org/edwindayot/echonest/downloads)](https://packagist.org/packages/edwindayot/echonest)
[![License](https://poser.pugx.org/edwindayot/echonest/license)](https://packagist.org/packages/edwindayot/echonest)

So here you are, searching for usefull methods to request the Echonest API with a speak-like language.
This Echonest Library helps you in this way, take a look :

### Initializing
First of all, you need to initialize the Echonest Library, just do it like this:
```php
<?php

  use Echonest\Facade\Echonest;

  $echonest = Echonest::init('YOUR_API_KEY');
```

And that's it, you've got your Echonest instance ! The only next thing to do is to give it as a parameter of the API category you want to use. Let's say you want to use the _Artist_ category:

```php
<?php

  use Echonest\Facade\EchonestArtists;
  
  $artists = new EchonestArtists($echonest);
```

### Requesting

Now, you'll be able to make all of your requests very simply. Let's say you want to search an artist which name is "Martin Garrix":

```php
<?php

  $artists->getSearch()->setName('Martin Garrix');
```

With only this, you'll get the _QueryBuilder_ instance, there is many methods you can use with the Fluent model. For instance, you could just want the Spotify's datas for this artist, so you can say:
```php
<?php

  $artists->getSearch()
    ->setName('Martin Garrix')
    ->setBucket('id:spotify');
```

There you are, now, you've got your QueryBuilder instance, and the only thing to do now is to _get_ the Query results:
```php
<?php

  $martin_garrix = $artists->getSearch()
    ->setName('Martin Garrix')
    ->setBucket('id:spotify')
    ->get();
```

Now, your martin_garrix is a collection, and there is a couple thing you can do at this point. The thing you'll use the most is the array transformation of the collection.

```php
<?php

  $martin_garrix = $artists->getSearch()
    ->setName('Martin Garrix')
    ->setBucket('id:spotify')
    ->get()
    ->toArray();
```

That's it, you've got your array.

These methods matches to the Echonest API specifications, so if you want to understand what is an id, or whatever, please refer to http://developer.echonest.com/docs/v4/.

So, since the `get()` method is launched, the QueryBuilder instance become an EchonestColletion instance, so the methods from the QueryBuilder aren't available anymore. Here is a list of the available methods for each API Category, for the QueryBuilder, and for the EchonestCollection:

## Artists
```php
<?php

  use Echonest\Facade\EchonestArtists;

  $artists->getBiographies($name);
  $artists->getBiographiesById($id);
  $artists->getBlogs($name);
  $artists->getBlogsById($id);
  $artists->getFamiliarity($name);
  $artists->getFamiliarityById($id);
  $artists->getHotttnesss($name);
  $artists->getHotttnesssById($id);
  $artists->getImages($name);
  $artists->getImagesById($id);
  $artists->getListTerms();
  $artists->getNews($name);
  $artists->getNewsById($id);
  $artists->getProfile($name);
  $artists->getProfileById($id);
  $artists->getReviews($name);
  $artists->getReviewsById($id);
  $artists->getSearch();
  $artists->getExtract($text);
  $artists->getSongs($name);
  $artists->getSongsById($id);
  $artists->getSimilar($name);
  $artists->getSimilarById($id);
  $artists->getSuggest($name);
  $artists->getTerms($name);
  $artists->getTermsById($id);
  $artists->getTopHottt();
  $artists->getTopTerms();
  $artists->getTwitter($name);
  $artists->getTwitterById($id);
  $artists->getUrls($name);
  $artists->getUrlsById($id);
  $artists->getVideo($name);
  $artists->getVideoById($id)
```

## Songs

```php
<?php

  use Echonest\Facade\EchonestSongs;

  $songs->getArtistSongs($name);
  $songs->searchSongs($title);
  $songs->getSongProfile($id);
```

## Genres

```php
<?php

  use Echonest\Facade\EchonestGenres;

  $genres->getArtists($name);
  $genres->getList();
  $genres->getProfile($name);
  $genres->getSearch($name);
  $genres->getSimilar($name);
```

## Tracks

```php
<?php

  use Echonest\Facade\EchonestTracks;
  
  $tracks->getTrackProfile($id);
  $tracks->getUploadTrack($url);
  $tracks->postUploadTrack($url);
```

## Query

```php
<?php

  $echonest->queryBuilder
    ->setApi('category_name')
    ->setCommand('method_name')
    ->setName('a name') // alias for setOption('name', 'a name')
    ->setId('anID') // alias for setOption('id', 'anID')
    ->setBucket('a_bucket') // alias for setOption('bucket', 'a_bucket')
    ->sortBy('a_sort_option', 'desc') // alias for setOption('sort', 'a_sort_option-desc')
    ->setOption('option_name', 'value')
    ->limit(3) // get 3 elements (0, 1, 2)
    ->limit(3, 2) // get 3 elements starting from 3rd base element (2, 3, 4)
    ->get();
```

## Collection

```php
<?php

  $artists->get()
    ->has('artists') // return bool
    ->orderBy('name')
    ->toArray(); // return the array transformed values of $items
```

Of course, the last method `toArray()` isn't necessary because of the ArrayAccess implements. The EchonestCollection var 'items' values are accessible as an array:

```php
<?php
  $array = $artists->get();
  
  echo $array['artists'];
```

Works fine as this:
```php
<?php
  $array = $artists->get();
  
  foreach ($array as $key => $value) {
    echo "$key = $value";
  }
```

So the `toArray()` is necessary only if you want to return it as _json_ or _xml_ for instance.

Enjoy ! (Do not forget to report any bug you found, and please tell me about the new features you want !)
