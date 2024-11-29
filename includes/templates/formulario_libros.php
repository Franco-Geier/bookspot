            <fieldset>
                <legend>Información del Libro</legend>

                <div class="formulario-nombres">
                    <div class="campo">
                        <label for="titulo">Título:</label>
                        <input
                            type="text"
                            id="titulo"
                            name="libro[titulo]"
                            placeholder="Título del libro"
                            value="<?php echo s($libro->titulo); ?>">
                    </div>
                    
                    <div class="campo">
                        <label for="autor">Autor:</label>
                        <input
                            type="text"
                            id="autor"
                            name="libro[autor]"
                            placeholder="Autor del libro"
                            value="<?php echo s($libro->autor); ?>">
                    </div>
                </div>

                <div class="campo">
                    <label for="descripcion">Descripción:</label>
                    <textarea
                        name="libro[descripcion]"
                        id="descripcion"
                        minlength="50"
                        maxlength="200"><?php echo s($libro->descripcion); ?>
                    </textarea>
                </div>

                <div class="formulario-nombres">
                    <div class="campo">
                        <label for="precio">Precio</label>
                        <input
                            type="number"
                            name="libro[precio]"
                            placeholder="Ej: 6000.50"
                            name="precio"
                            min="1000"
                            max="150000"
                            step="0.01"
                            id="precio"
                            value="<?php echo s($libro->precio); ?>">
                    </div>

                    <div class="campo">
                        <label for="stock">Stock</label>
                        <input
                            type="number"
                            name="libro[stock]"
                            placeholder="Ej: 3"
                            name="stock"
                            min="1"
                            max="100"
                            id="stock"
                            value="<?php echo s($libro->stock); ?>">
                    </div>
                </div>

                <div class="campo">
                    <label for="categoria">Categoría</label>
                    <select name="libro[id_categoria]" id="categoria">
                        <option value="" disabled selected>-- Seleccione --</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option 
                                value="<?php echo s($categoria->id); ?>" 
                                <?php echo $libro->id_categoria == $categoria->id ? "selected" : ""; ?>>
                                <?php echo s($categoria->nombre); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                        
                <div class="campo">
                    <label for="editorial">Editorial</label>
                    <select name="libro[id_editorial]" id="editorial">
                        <option value="" disabled selected>-- Seleccione --</option>
                        <?php foreach ($editoriales as $editorial): ?>
                            <option 
                                value="<?php echo s($editorial->id); ?>" 
                                <?php echo $libro->id_editorial == $editorial->id ? "selected" : ""; ?>>
                                <?php echo s($editorial->nombre); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="campo">
                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" accept="image/jpeg" name="libro[imagen]">
                    <?php if($libro->imagen) :?>
                        <img src="../../imagenes/<?php echo $libro->imagen; ?>" class="imagen-small">
                    <?php endif; ?>
                </div>
            </fieldset>