CYanHeiHK (昭源甄黑體)
====================

[Click here for Chinese version 中文版請按此](README.zh.md)  

## Table of Contents

  * [Background](#background)
  * [Differences to the original product](#differences-to-the-original-product)
  * [Scope of review process](#scope-of-review-process)
  * [Available weights](#supported-weights)
  * [About this repository](#about-this-repository)
  * [Using the command line tools](#using-the-command-line-tools)
  * **[Download](#download)**
  * [Important notes](#important-notes)
  * [Disclaimer](#disclaimer)

CYanHeiHK is an OpenType font based on Source Han Sans (SHS) from Adobe and Google (it is called Noto Sans CJK when distributed by Google). A number of glyphs have been modified so that it is more suitable for use in Hong Kong.

## Background

The following issues are observed in the current Source Han Sans release:

1. In Unicode, a codepoint can be represented by different glyphs in different regions due to [Han Unification](https://en.wikipedia.org/wiki/Han_unification). Currently, Source Han Sans supports four favours in terms of language dependent glyphs, and they are Simplified Chinese (following PRC's glyph standard), Traditional Chinese (following Taiwan's glyph standard), Japanese and Korean. So far there is no Traditional Chinese version targeting Hong Kong's character standard (usually refers to the *List of Graphemes of Commonly-used Chinese Characters 常用字字形表* published by the Hong Kong Education Bureau).
2. For practical reason, a non-standard glyph is sometimes more preferred. The happens when users are already familiar to a glyph long before the standard was born, but the authority picked a somewhat unfamiliar shape as the standard.

A Source Han Sans version that adheres to Hong Kong's glyph standard is currently planned, which will essentially resolve the first issue. However, the release date of SHS-HK is still yet to be announced, and such a release won't serve all use cases. In particular, while it is good to have a release that follows Hong Kong's glyph standard, it may not be always preferred by the community given the discrepancy between the “standard” and “conventional” appearance of some characters.

## Differences to the original product

Currently, CYanHeiHK is based on the Traditional Chinese (Taiwan) variant of Source Han Sans (version 1.004). 

The following image serves as an introduction to the font in Chinese, which demonstrates some differences to its base:

![Font intro](doc/images/intro.png?raw=true "About this font, in Chinese")

And here is a summary: 

1. Some glyphs are modified to conform to HK standard.
2. Some glyphs are modified to use the more conventional form.
2. Glyphs having certain components are modified to their traditional forms as I believe they are more suitable for Gothic style. Example of affected components are 艹, 女, 雨, ⺼.
3. Some glyphs are tuned so that they appear better in Regular weight.
4. The 辶 component is redesigned. 
5. Sizes of some full-width punctuations (，。、：；！？) are adjusted.
6. A small number of glyphs are modified to comply with HK's standard, even though such a character already exist but in different codepoints. For this part, only glyphs of the following two components are affected: (a) 兌 → 兑, thus 說 → 説, 悅 → 悦; and (b) 𥁕 → 昷, thus 溫 → 温. HK uses the latter glyphs, but many people are more accustomed to enter the former glyphs through IME due to historical reasons.
7. Lastly, appearances of the half-width, proportional digit “1” and letter “g” are changed. The bottom horizontal line of “1” has been removed, and “g” is changed to single-storey form.    

## Scope of review process

The language specific version of Source Han Sans Traditional Chinese covers >44,600 ideographs. Among them, characters covered by Big5 or HKSCS (>17,600 characters) are adjusted to comply with Taiwan's MoE standard. 

To achieve the goal of this project i.e. making it more suitable for Hong Kong, characters in the font have to be reviewed and adjustments (either by remapping or modification) have to be made where necessary. As this is a personal project in spare time, it would be impractical for me to go through all characters in the original font to hunt and fix every shape. Even the number of characters in the Big5 + HKSCS scope is considered too large. Hence the following heuristic:

1. Characters covered in Big5 and HKSCS encodings are treated as the maximum supported set, which means that characters beyond this range will be ignored by default. The list is extracted using the `Unihan_OtherMappings.txt` file in the [Unihan database](http://www.unicode.org/Public/UCD/latest/ucd/). From the file, there are 17,642 characters in total, among which 13,063 are in Big5 and 4,579 are in HKSCS.
2. 4,805 characters listed in *常用字字形表 (List of Graphemes of Commonly-used Chinese Characters)* are actively reviewed and fixes will be applied when necessary. They are extracted from EDB's [*Lexical Lists for Chinese Learning in Hong Kong* (香港小學學習字詞表)  website](http://www.edbchinese.hk/lexlist_ch/index.htm). The list contains most of the frequently used characters in Hong Kong. As expected, all characters are included by either Big5 or HKSCS.
3. **New in 1.002:** 5,224 characters listed in IICORE with Hong Kong source identifier (H1A - H1F) are also reviewed and fixed. The source file can be found [here](http://www.unicode.org/L2/L2010/10375-02n4153-files/IICORE.txt). This results in 456 additional characters to be processed. Also worth noting is that there are characters in *常用字字形表* not covered by IICORE, so it cannot be seen as a subset of IICORE.

This should cover most characters needed for daily use in Hong Kong. Other Big5 and HKSCS characters will not be *actively* reviewed and fixed. Despite this statement, I actually went through all HKSCS characters roughly and tagged those that are deemed useful, or when a fix is simple.

The font still includes all characters covered by the original Source Han Sans TC, just that the unreviewed characters are not guaranteed to meet the “suitable for Hong Kong” goal as defined in this product. For instance, the font includes the character 縎 (Big5: EAD3), but its 骨 component does not adhere to Hong Kong's glyph standard. It is left unmodified due to its rare use. The situation should improve after Source Han Sans HK is released in the future, which CYanHeiHK will certainly use as the new base version to work upon.

## Available weights

Light, Regular and Bold version of the font are provided.

## About this repository

This repository does not only include the font files, but also the script and data files that I use to help create such product. Feel free to build it yourself, or modify it to suit your need.

## Using the command line tools

See [COMMANDS.md](doc/COMMANDS.md) for details.  

## Download

Visit the [releases](https://github.com/tamcy/CYanHeiHK/releases) page to download the fonts. Currently two desktop builds and one web font build are available for download.

### Desktop builds

The font offers two variants for desktop use. Note that the font names are exactly the same, so you cannot install both.
  
* `CYanHeiHK_{version}.7z` is the “normal version” of the OpenType (.OTF) font files. You're probably looking for this.
* `CYanHeiHK_{version}_adjusted_fontbbox.7z` is the “adjusted Font BBox version”, provided to work around some edge cases caused by the features inherited from Source Han Sans. [Click here for more information](doc/FONTBBOX-ADJUSTED-VERSION.md). Only use it when you understand what it does.
 
The zip file contains the installable fonts, the license file, and a *changes.html* file which you can use to examine the changed glyphs after installing the fonts. Source Han Sans TW also needs to be installed for the reference glyph to display correctly.

### Web font build

`CYanHeiHK_{version}_webfont.7z` is a special build of the font dedicated for the web. It contains a subsetted version of CYanHeiHK (8,700 codepoints), with most OpenType features removed to save space.

For Chinese character glyphs,
   * characters listed in IICORE with Hong Kong, Macau, Taiwan, or Japan source identifier are included. For Japan source, only those overlapping the Big5 or HKSCS code range are included;
   * characters revised (either remapped or modified) for Hong Kong's needs in this project are always included;
   * additional characters manually selected to include in the web font. These are mostly HKSCS characters (e.g. 㗅, 喆).  

For non-Chinese character glyphs,
   * ASCII, punctuation marks, full-width characters, Hiragana and Katakana symbols are included.
  
The package is supplied with fonts in WOFF and WOFF2 formats. Most modern browsers should support either one or both. Also, *hinted* and *unhinted* version are provided for each format and each weight.

## Important notes

* Due to the special handling of the “兌” component, there will be two codepoints sharing the same glyph for characters which 兌 is the only distinguishing feature. For instance, 說 (U+8AAA) and 説 (U+8AAC) will both appear as 言+兑 (U+8AAC). As a result, this font is not suitable for situation where such discrimination is essential. The same is applied to characters with the “𥁕” component. 
* The original language specific OTFs contain glyphs of the non-default language, so that users can access them using the same font resource through the ‘locl’ GSUB feature in OpenType. This feature still exists in CYanHeiHK, but should not be relied on because the HK glyphs are developed by selecting the region specific glyphs closest to the desired form and modify them when necessary. I plan to remove this ‘locl’ feature in the future.   

## Disclaimer

The CYanHeiHK font and its tools are free for use. The author shall not be responsible or liable for any loss or damage of any kind caused by using this product. For license information of the font, see [LICENSE.txt](LICENSE.txt).