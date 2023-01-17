<h1>MazeAPI</h1>
<p>An API for generating maze images</p>
<p>The API uses <a href="https://mazegenerator.net/">https://mazegenerator.net/</a> to get the maze images</p>

<h2>Documentation</h2>

<h3>Get Maze</h3>
<p>GET /{maze.tag}</p>

<h4>Parameters</h4>
<table>
    <thead>
        <tr>
            <th>FIELD</th>
            <th>TYPE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>solve</td>
            <td>?boolean</td>
            <td>Whether or not to show the solution of the maze</td>
        </tr>
    </tbody>
</table>

<h3>Create Maze</h3>
<p>POST /</p>

<table>
    <thead>
        <tr>
            <th>FIELD</th>
            <th>TYPE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>shape</td>
            <td>
                <a href="#ShapeType">maze shape type</a>
            </td>
            <td>The shape of the maze</td>
        </tr>
        <tr>
            <td>data</td>
            <td>
                <a href="#MazeData">maze data</a>
            </td>
            <td>The data of the maze</td>
        </tr>
    </tbody>
</table>

<h4 id="ShapeType">Maze Shape Type</h4>
<table>
    <thead>
        <tr>
            <th>NAME</th>
            <th>VALUE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Rectangular</td>
            <td>1</td>
            <td>Rectangular maze shape</td>
        </tr>
        <tr>
            <td>Circular</td>
            <td>2</td>
            <td>Circular maze shape</td>
        </tr>
        <tr>
            <td>Triangular</td>
            <td>3</td>
            <td>Triangular maze shape</td>
        </tr>
        <tr>
            <td>Hexagonal</td>
            <td>4</td>
            <td>Hexagonal maze shape</td>
        </tr>
    </tbody>
</table>

<h4 id="MazeData">Maze Data Structure</h4>

<h5>Rectangular Maze</h5>
<table>
    <thead>
        <tr>
            <th>FIELD</th>
            <th>TYPE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>style</td>
            <td>?<a href="#MazeStyle">maze style type</a></td>
            <td>The style of the maze</td>
        </tr>
        <tr>
            <td>width</td>
            <td>?integer</td>
            <td>The width of the maze (2-200)</td>
        </tr>
        <tr>
            <td>height</td>
            <td>?integer</td>
            <td>The height of the maze (2-200)</td>
        </tr>
        <tr>
            <td>innerwidth</td>
            <td>?integer</td>
            <td>The inner width of the maze (0 or 2 to width - 2 cells)</td>
        </tr>
        <tr>
            <td>innerheight</td>
            <td>?integer</td>
            <td>The inner height of the maze (0 or 2 to width - 2 cells)</td>
        </tr>
        <tr>
            <td>startsat</td>
            <td>?<a href="#RectMazeStartsAt">Rectangular Maze Starting Position</a></td>
            <td>The starting position of the maze</td>
        </tr>
    </tbody>
</table>

<h6 id="RectMazeStartsAt">Rectangular Maze Starting Position</h6>
<table>
    <thead>
        <tr>
            <th>NAME</th>
            <th>VALUE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Top</td>
            <td>1</td>
            <td>Maze top starting position</td>
        </tr>
        <tr>
            <td>Bottom or inner room</td>
            <td>2</td>
            <td>Maze bottom starting position (inner room if inner width and height are 2 or more)</td>
        </tr>
    </tbody>
</table>

<h5>Circular Maze</h5>
<table>
    <thead>
        <tr>
            <th>FIELD</th>
            <th>TYPE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>outerdiameter</td>
            <td>?integer</td>
            <td>Maze outer diameter (5-200)</td>
        </tr>
        <tr>
            <td>innerdiameter</td>
            <td>?integer</td>
            <td>Maze inner diameter (3 to outer diameter - 2 cells)</td>
        </tr>
        <tr>
            <td>horizontalbias</td>
            <td>?boolean</td>
            <td>Prioritize circular corridors</td>
        </tr>
        <tr>
            <td>startsat</td>
            <td>?<a href="#CircMazeStartsAt">Circular Maze Starting Position</a></td>
            <td>The starting position of the maze</td>
        </tr>
    </tbody>
</table>

<h6 id="CircMazeStartsAt">Circular Maze Starting Position</h6>
<table>
    <thead>
        <tr>
            <th>NAME</th>
            <th>VALUE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Top</td>
            <td>1</td>
            <td>Maze top starting position</td>
        </tr>
        <tr>
            <td>Center</td>
            <td>2</td>
            <td>Maze center starting position</td>
        </tr>
    </tbody>
</table>

<h5>Triangular Maze</h5>
<table>
    <thead>
        <tr>
            <th>FIELD</th>
            <th>TYPE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>sidelength</td>
            <td>?integer</td>
            <td>Maze side length (3-200)</td>
        </tr>
        <tr>
            <td>innersidelength</td>
            <td>?integer</td>
            <td>Maze inner side length (0 or side length - 3×X cells)</td>
        </tr>
        <tr>
            <td>startsat</td>
            <td>?<a href="#TriaMazeStartsAt">Triangular Maze Starting Position</a></td>
            <td>The starting position of the maze</td>
        </tr>
    </tbody>
</table>

<h6 id="TriaMazeStartsAt">Triangular Maze Starting Position</h6>
<table>
    <thead>
        <tr>
            <th>NAME</th>
            <th>VALUE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Left side</td>
            <td>1</td>
            <td>Maze left side starting position</td>
        </tr>
        <tr>
            <td>Right side or inner room</td>
            <td>2</td>
            <td>Maze right side starting position (inner room if inner side length is more than 0)</td>
        </tr>
    </tbody>
</table>

<h5>Hexagonal Maze</h5>
<table>
    <thead>
        <tr>
            <th>FIELD</th>
            <th>TYPE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>style</td>
            <td>?<a href="#MazeStyle">Maze Style Type</a></td>
            <td>The style of the maze</td>
        </tr>
        <tr>
            <td>sidelength</td>
            <td>?integer</td>
            <td>Maze side length (2-120)</td>
        </tr>
        <tr>
            <td>innersidelength</td>
            <td>?integer</td>
            <td>Maze inner side length (0 or less than side length cells)</td>
        </tr>
        <tr>
            <td>startsat</td>
            <td>?<a href="#HexMazeStartsAt">Hexagonal Maze Starting Position</a></td>
            <td>The starting position of the maze</td>
        </tr>
    </tbody>
</table>

<h6 id="HexMazeStartsAt">Hexagonal Maze Starting Position</h6>
<table>
    <thead>
        <tr>
            <th>NAME</th>
            <th>VALUE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Top</td>
            <td>1</td>
            <td>Maze top starting position</td>
        </tr>
        <tr>
            <td>Bottom or inner room</td>
            <td>2</td>
            <td>Maze bottom starting position (inner room if inner side length is more than 0)</td>
        </tr>
    </tbody>
</table>

<h5 id="MazeStyle">Maze Style Type</h5>
<table>
    <thead>
        <tr>
            <th>NAME</th>
            <th>VALUE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Orthogonal*</td>
            <td>1</td>
            <td>Square cell maze style</td>
        </tr>
        <tr>
            <td>Sigma</td>
            <td>2</td>
            <td>Hexagonal cell maze style</td>
        </tr>
        <tr>
            <td>Delta</td>
            <td>3</td>
            <td>Triangular cell maze style</td>
        </tr>
    </tbody>
</table>
<p>* Only available with the rectangular maze shape</p>
