<h2>Definition</h2>

- The BMP file format, also known as bitmap image file,device independent bitmap (DIB) file format and bitmap, 
 is a raster graphics image file format used to store bitmap digital images, independently of the display device 

- The BMP file format is capable of storing two-dimensional digital images both monochrome and color, 
 in various color depths, and optionally with data compression, alpha channels, and color profiles. 
 <h2>File Structure</h2>

<h3>Table of BMP structure:</h3>
<table class="wikitable">
<tbody><tr>
<th>Structure name
</th>
<th>Optional
</th>
<th>Size
</th>
<th>Purpose
</th>
<th>Comments
</th></tr>
<tr>
<th>Bitmap file header
</th>
<td style="background:#FFC7C7;vertical-align:middle;text-align:center;" class="table-no">No
</td>
<td>14 bytes
</td>
<td>To store general information about the bitmap image file
</td>
<td>Not needed after the file is loaded in memory
</td></tr>
<tr>
<th>DIB header
</th>
<td style="background:#FFC7C7;vertical-align:middle;text-align:center;" class="table-no">No
</td>
<td>Fixed-size <br />(7 different versions exist)
</td>
<td>To store detailed information about the bitmap image and define the pixel format
</td>
<td>Immediately follows the Bitmap file header
</td></tr>
<tr>
<th>Extra bit masks
</th>
<td style="background:#9EFF9E;vertical-align:middle;text-align:center;" class="table-yes">Yes
</td>
<td>3 or 4 <a href="/wiki/DWORD" class="mw-redirect" title="DWORD">DWORDs</a><sup id="cite_ref-AlphaBitFields_6-0" class="reference"><a href="#cite_note-AlphaBitFields-6">&#91;6&#93;</a></sup><br />(12 or 16 bytes)
</td>
<td>To define the pixel format
</td>
<td>Present only in case the DIB header is the <link rel="mw-deduplicated-inline-style" href="mw-data:TemplateStyles:r886049734"/><span class="monospaced">BITMAPINFOHEADER</span> and the Compression Method member is set to either BI_BITFIELDS or BI_ALPHABITFIELDS
</td></tr>
<tr>
<th>Color table
</th>
<td style="background: #DFD; vertical-align: middle; text-align: center;">Semi-optional
</td>
<td data-sort-value="" style="background: #EEE; vertical-align: middle; text-align: center;" class="table-na">Variable size
</td>
<td>To define colors used by the bitmap image data (Pixel array)
</td>
<td>Mandatory for <a href="/wiki/Color_depth" title="Color depth">color depths</a> ≤ 8 bits
</td></tr>
<tr>
<th>Gap1
</th>
<td style="background:#9EFF9E;vertical-align:middle;text-align:center;" class="table-yes">Yes
</td>
<td data-sort-value="" style="background: #EEE; vertical-align: middle; text-align: center;" class="table-na">Variable size
</td>
<td>Structure alignment
</td>
<td>An artifact of the File offset to Pixel array in the Bitmap file header
</td></tr>
<tr>
<th>Pixel array
</th>
<td style="background:#FFC7C7;vertical-align:middle;text-align:center;" class="table-no">No
</td>
<td data-sort-value="" style="background: #EEE; vertical-align: middle; text-align: center;" class="table-na">Variable size
</td>
<td>To define the actual values of the pixels
</td>
<td>The pixel format is defined by the DIB header or Extra bit masks. Each row in the Pixel array is padded to a multiple of 4 bytes in size
</td></tr>
<tr>
<th>Gap2
</th>
<td style="background:#9EFF9E;vertical-align:middle;text-align:center;" class="table-yes">Yes
</td>
<td data-sort-value="" style="background: #EEE; vertical-align: middle; text-align: center;" class="table-na">Variable size
</td>
<td>Structure alignment
</td>
<td>An artifact of the ICC profile data offset field in the DIB header
</td></tr>
<tr>
<th>ICC color profile
</th>
<td style="background:#9EFF9E;vertical-align:middle;text-align:center;" class="table-yes">Yes
</td>
<td data-sort-value="" style="background: #EEE; vertical-align: middle; text-align: center;" class="table-na">Variable size
</td>
<td>To define the color profile for color management
</td>
<td>Can also contain a path to an external file containing the color profile. When loaded in memory as "non-packed DIB", it is located between the color table and Gap1.<sup id="cite_ref-DIBHeaderTypes_7-0" class="reference"><a href="#cite_note-DIBHeaderTypes-7">&#91;7&#93;</a></sup>
</td></tr></tbody></table><div style="clear:left;"></div>

<h3>File Header:</h3>

![image](https://user-images.githubusercontent.com/100038173/164148508-93605e39-2d30-4435-aa4b-8abaa7b0b999.png)
  
   - Note that BMP must start with 42 4D and then the next 4 bytes is the size of total bytes in the file (need to be converted to hex). The next 4 bytes is reserved but mostly don't use and the next 4 bytes is for the offset(possition in this file) when the actual image data starts(must always be 54 in dec and 36 in hex) 
   - There are 14 bytes in total in this part
  
<h3>DIB headers:</h3>

   - There are many different versions of this section but the most common for Windows nowadays is BITMAPINFOHEADER header which has total of 40 bytes:
   
   
  ![image](https://user-images.githubusercontent.com/100038173/164150414-b4bd4e54-2f54-4767-8dee-67667f86ddba.png)
   - The compression method (offset 30) can be:
   ![image](https://user-images.githubusercontent.com/100038173/164151247-6c223d2c-3044-432c-8ae1-a1525173ed5e.png)
   <h3>Color table:</h3>
   
   - The color table is a block of bytes (a table) listing the colors used by the image. Each pixel in an indexed color image is described by a number of bits (1, 4, or 8) which is an index of a single color described by this table. The purpose of the color palette in indexed color bitmaps is to inform the application about the actual color that each of these index values corresponds to. 
   The purpose of the color table in non-indexed (non-palettized) bitmaps is to list the colors used by the bitmap for the purposes of optimization on devices with limited color display capability and to facilitate future conversion to different pixel formats and paletization.
   - The color table (palette) occurs in the BMP image file directly after the BMP file header, the DIB header, and after the optional three or four bitmasks if the BITMAPINFOHEADER header with BI_BITFIELDS (12 bytes) or BI_ALPHABITFIELDS (16 bytes) option is used. 
   - The color table is normally not used when the pixels are in the 16-bit per pixel (16bpp) format (and higher); there are normally no color table entries in those bitmap image files
   <h3>Pixel Storage:</h3>
   - The bits representing the bitmap pixels are packed in rows. The size of each row is rounded up to a multiple of 4 bytes (a 32-bit DWORD) by padding.
     For images with height above 1, multiple padded rows are stored consecutively, forming a Pixel Array.
   - The total number of bytes necessary to store one row of pixels can be calculated as:
  
   ![image](https://user-images.githubusercontent.com/100038173/164152091-8a202507-2516-4db2-afb0-dd814a7f6957.png)
   - The total number of bytes necessary to store an array of pixels in an n bits per pixel (bpp) image, with 2n colors, can be calculated by accounting for the effect of rounding up the size of each row to a multiple of 4 bytes, as follows:
  
   ![image](https://user-images.githubusercontent.com/100038173/164152201-9081f0fe-c65e-4aec-9939-f3ab07b388c2.png)
   <h3>Pixel array (bitmap data):</h3>
   
   - The pixel array is a block of 32-bit DWORDs, that describes the image pixel by pixel. Usually pixels are stored "bottom-up", starting in the lower left corner, going from left to right, and then row by row from the bottom to the top of the image.[5] Unless BITMAPCOREHEADER is used, uncompressed Windows bitmaps also can be stored from the top to bottom, when the Image Height value is negative.
  <h3>Pixel Format:</h3> 
  
  - The 1-bit per pixel (1bpp) format supports 2 distinct colors, (for example: black and white). The pixel values are stored in each bit, with the first (left-most) pixel in the most-significant bit of the first byte.[5] Each bit is an index into a table of 2 colors. An unset bit will refer to the first color table entry, and a set bit will refer to the last (second) color table entry.
  - The 2-bit per pixel (2bpp) format supports 4 distinct colors and stores 4 pixels per 1 byte, the left-most pixel being in the two most significant bits (Windows CE only:[20]). Each pixel value is a 2-bit index into a table of up to 4 colors.
  - The 4-bit per pixel (4bpp) format supports 16 distinct colors and stores 2 pixels per 1 byte, the left-most pixel being in the more significant nibble.[5] Each pixel value is a 4-bit index into a table of up to 16 colors.
  - The 8-bit per pixel (8bpp) format supports 256 distinct colors and stores 1 pixel per 1 byte. Each byte is an index into a table of up to 256 colors.
  - The 16-bit per pixel (16bpp) format supports 65536 distinct colors and stores 1 pixel per 2-byte WORD. Each WORD can define the alpha, red, green and blue samples of the pixel.
  - The 24-bit per pixel (24bpp) format supports 16,777,216 distinct colors and stores 1 pixel value per 3 bytes. Each pixel value defines the red, green and blue samples of the pixel (8.8.8.0.0 in RGBAX notation). Specifically, in the order: blue, green and red (8 bits per each sample).[5]
  - The 32-bit per pixel (32bpp) format supports 4,294,967,296 distinct colors and stores 1 pixel per 4-byte DWORD. Each DWORD can define the alpha, red, green and blue samples of the pixel.
<h2>Example of a 2×2 pixel, 24-bit bitmap (Windows DIB header BITMAPINFOHEADER) with pixel format RGB24 </h2>

 - Original:
 
 ![image](https://user-images.githubusercontent.com/100038173/164153984-bddc1c18-0a8e-480b-9e49-776d9ec504be.png)

 - Breakdown:

<table class="wikitable" style="float:left; margin: 1em auto 1em auto">
<tbody><tr>
<th style="padding: 0px 10px">Offset
</th>
<th style="padding: 0px 10px">Size
</th>
<th style="padding: 0px 10px">Hex value
</th>
<th style="padding: 0px 10px">Value
</th>
<th style="padding: 0px 10px">Description
</th></tr>
<tr>
<td colspan="5" style="text-align: center;">BMP Header
</td></tr>
<tr>
<td align="center">0h
</td>
<td align="center">2
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">42 4D
</td>
<td style="padding: 0px 10px">"BM"
</td>
<td style="padding: 0px 10px">ID field (42h, 4Dh)
</td></tr>
<tr>
<td align="center">2h
</td>
<td align="center">4
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">46&#160;00&#160;00&#160;00
</td>
<td style="padding: 0px 10px">70 bytes (54+16)
</td>
<td style="padding: 0px 10px">Size of the BMP file (54 bytes header + 16 bytes data)
</td></tr>
<tr>
<td align="center">6h
</td>
<td align="center">2
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">00 00
</td>
<td style="padding: 0px 10px">Unused
</td>
<td style="padding: 0px 10px">Application specific
</td></tr>
<tr>
<td align="center">8h
</td>
<td align="center">2
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">00 00
</td>
<td style="padding: 0px 10px">Unused
</td>
<td style="padding: 0px 10px">Application specific
</td></tr>
<tr>
<td align="center">Ah
</td>
<td align="center">4
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">36 00 00 00
</td>
<td style="padding: 0px 10px">54 bytes (14+40)
</td>
<td style="padding: 0px 10px">Offset where the pixel array (bitmap data) can be found
</td></tr>
<tr>
<td colspan="5" style="text-align: center;">DIB Header
</td></tr>
<tr>
<td align="center">Eh
</td>
<td align="center">4
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">28 00 00 00
</td>
<td style="padding: 0px 10px">40 bytes
</td>
<td style="padding: 0px 10px">Number of bytes in the DIB header (from this point)
</td></tr>
<tr>
<td align="center">12h
</td>
<td align="center">4
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">02 00 00 00
</td>
<td style="padding: 0px 10px">2 pixels (left to right order)
</td>
<td style="padding: 0px 10px">Width of the bitmap in pixels
</td></tr>
<tr>
<td align="center">16h
</td>
<td align="center">4
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">02 00 00 00
</td>
<td style="padding: 0px 10px">2 pixels (bottom to top order)
</td>
<td style="padding: 0px 10px">Height of the bitmap in pixels. Positive for bottom to top pixel order.
</td></tr>
<tr>
<td align="center">1Ah
</td>
<td align="center">2
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">01 00
</td>
<td style="padding: 0px 10px">1 plane
</td>
<td style="padding: 0px 10px">Number of color planes being used
</td></tr>
<tr>
<td align="center">1Ch
</td>
<td align="center">2
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">18 00
</td>
<td style="padding: 0px 10px">24 bits
</td>
<td style="padding: 0px 10px">Number of bits per pixel
</td></tr>
<tr>
<td align="center">1Eh
</td>
<td align="center">4
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">00 00 00 00
</td>
<td style="padding: 0px 10px">0
</td>
<td style="padding: 0px 10px">BI_RGB, no pixel array compression used
</td></tr>
<tr>
<td align="center">22h
</td>
<td align="center">4
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">10 00 00 00
</td>
<td style="padding: 0px 10px">16 bytes
</td>
<td style="padding: 0px 10px">Size of the raw bitmap data (including padding)
</td></tr>
<tr>
<td align="center">26h
</td>
<td align="center">4
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">13 0B 00 00
</td>
<td style="padding: 0px 10px">2835 pixels/metre horizontal
</td>
<td style="padding: 0px 10px" rowspan="2">Print resolution of the image,<br /><a href="/wiki/Dots_per_inch" title="Dots per inch">72 DPI</a> &#215; 39.3701 inches per metre yields 2834.6472
</td></tr>
<tr>
<td align="center">2Ah
</td>
<td align="center">4
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">13 0B 00 00
</td>
<td style="padding: 0px 10px">2835 pixels/metre vertical
</td></tr>
<tr>
<td align="center">2Eh
</td>
<td align="center">4
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">00 00 00 00
</td>
<td style="padding: 0px 10px">0 colors
</td>
<td style="padding: 0px 10px">Number of colors in the palette
</td></tr>
<tr>
<td align="center">32h
</td>
<td align="center">4
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">00 00 00 00
</td>
<td style="padding: 0px 10px">0 important colors
</td>
<td style="padding: 0px 10px">0 means all colors are important
</td></tr>
<tr>
<td colspan="5" align="center">Start of pixel array (bitmap data)
</td></tr>
<tr>
<td align="center">36h
</td>
<td align="center">3
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">00 00 FF
</td>
<td style="padding: 0px 10px">0 0 255
</td>
<td style="padding: 0px 10px">Red, Pixel (0,1)
</td></tr>
<tr>
<td align="center">39h
</td>
<td align="center">3
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">FF FF FF
</td>
<td style="padding: 0px 10px">255 255 255
</td>
<td style="padding: 0px 10px">White, Pixel (1,1)
</td></tr>
<tr>
<td align="center">3Ch
</td>
<td align="center">2
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">00 00
</td>
<td style="padding: 0px 10px">0 0
</td>
<td style="padding: 0px 10px">Padding for 4 byte alignment (could be a value other than zero)
</td></tr>
<tr>
<td align="center">3Eh
</td>
<td align="center">3
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">FF 00 00
</td>
<td style="padding: 0px 10px">255 0 0
</td>
<td style="padding: 0px 10px">Blue, Pixel (0,0)
</td></tr>
<tr>
<td align="center">41h
</td>
<td align="center">3
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">00 FF 00
</td>
<td style="padding: 0px 10px">0 255 0
</td>
<td style="padding: 0px 10px">Green, Pixel (1,0)
</td></tr>
<tr>
<td align="center">44h
</td>
<td align="center">2
</td>
<td style="padding: 0px 20px; white-space: nowrap; font-family:monospace;">00 00
</td>
<td style="padding: 0px 10px">0 0
</td>
<td style="padding: 0px 10px">Padding for 4 byte alignment (could be a value other than zero)
</td></tr></tbody></table><div style="clear:left;"></div>

- Result: 
  
![image](https://user-images.githubusercontent.com/100038173/164154026-4313909d-14af-4ed8-b45d-1b7f80a89e70.png)

<h2>Summary:</h2>
 
 - <strong>BMP file is usually very large</strong>
 - <strong>A bitmap file must start with 42 4D (offset 0 and 1)</strong>
 - <strong>If using BITMAPINFOHEADER (most common):<br>-The size of file header is 14 bytes, DIB header is 40 bytes -> Total 54. Therefore, the Pixel Data must start after the offset 54 and so in the file header the address of Pixel Data ( offset 0A) must be 36(hex) (values 54 in decimal).<br>Offset 0E (which starts the DIB header and also shows the number of bytes of DIB: 40 bytes) must be 28(hex) (values 40 in decimal).</strong>
 - <strong>Every number in the file format must be in hex</strong>
