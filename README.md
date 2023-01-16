# MazeAPI
An API for generating maze svgs

The API uses https://mazegenerator.net/ to get the maze svgs

## Documentation
The options below should be added to the url search parameters

**Do not** add true/false to boolean options. for true add the parameter, for false don't add the parameter
Example (true): `https://maze.jaronline.dev/?shape=2&horizontalbias`

### Rectangular Maze
`https://maze.jaronline.dev/?shape=1`

#### Options
<table>
  <thead>
    <tr>
      <th>
        <strong>FIELD</strong>
      </th>
      <th>
        <strong>TYPE</strong>
      </th>
      <th>
        <strong>DESCRIPTION</strong>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>style</td>
      <td>?integer</td>
      <td>maze style (1-3)</td>
    </tr>
    <tr>
      <td>width</td>
      <td>?integer</td>
      <td>maze width (2-200)</td>
    </tr>
    <tr>
      <td>height</td>
      <td>?integer</td>
      <td>maze height (2-200)</td>
    </tr>
    <tr>
      <td>innerwidth</td>
      <td>?integer</td>
      <td>maze inner width (0-2)</td>
    </tr>
    <tr>
      <td>innerheight</td>
      <td>?integer</td>
      <td>maze inner height (0-2)</td>
    </tr>
    <tr>
      <td>startsat</td>
      <td>?integer</td>
      <td>maze starting location (1-2)</td>
    </tr>
  </tbody>
</table>

### Circular Maze
`https://maze.jaronline.dev/?shape=2`

#### Options
<table>
  <thead>
    <tr>
      <th>
        <strong>FIELD</strong>
      </th>
      <th>
        <strong>TYPE</strong>
      </th>
      <th>
        <strong>DESCRIPTION</strong>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>outerdiameter</td>
      <td>?integer</td>
      <td>maze outer diameter (5-200)</td>
    </tr>
    <tr>
      <td>innerdiameter</td>
      <td>?integer</td>
      <td>maze outer diameter (minimal 3, maximum outerdiameter - 2 cells)</td>
    </tr>
    <tr>
      <td>startsat</td>
      <td>?integer</td>
      <td>maze starting location (1-2)</td>
    </tr>
    <tr>
      <td>horizontalbias</td>
      <td>?bool</td>
      <td>prioritize circular corridors</td>
    </tr>
  </tbody>
</table>

### Triangular Maze
`https://maze.jaronline.dev/?shape=3`

#### Options
<table>
  <thead>
    <tr>
      <th>
        <strong>FIELD</strong>
      </th>
      <th>
        <strong>TYPE</strong>
      </th>
      <th>
        <strong>DESCRIPTION</strong>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>sidelength</td>
      <td>?integer</td>
      <td>maze side length (3-200)</td>
    </tr>
    <tr>
      <td>innersidelength</td>
      <td>?integer</td>
      <td>maze inner side length (0 or side length - 3xX cells)</td>
    </tr>
    <tr>
      <td>startsat</td>
      <td>?integer</td>
      <td>maze starting location (1-2)</td>
    </tr>
  </tbody>
</table>

### Hexagonal Maze
`https://maze.jaronline.dev/?shape=4`

#### Options
<table>
  <thead>
    <tr>
      <th>
        <strong>FIELD</strong>
      </th>
      <th>
        <strong>TYPE</strong>
      </th>
      <th>
        <strong>DESCRIPTION</strong>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>style</td>
      <td>?integer</td>
      <td>maze style (2-3)</td>
    </tr>
    <tr>
      <td>sidelength</td>
      <td>?integer</td>
      <td>maze side length (2-120)</td>
    </tr>
    <tr>
      <td>innersidelength</td>
      <td>?integer</td>
      <td>maze inner side length (0 or less than side length cells)</td>
    </tr>
    <tr>
      <td>startsat</td>
      <td>?integer</td>
      <td>maze starting location (1-2)</td>
    </tr>
  </tbody>
</table>
