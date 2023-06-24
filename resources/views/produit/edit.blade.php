<link rel="stylesheet" href="{{asset('dashboard/css/style.css')}}">
<div class="container">
    <div class="rowe">
        <div class="col-md-6">
            <div class="carde">
                <div class="carde-body1">
                    <h2>Modifier le produit</h2>

                    <form action="{{ route('produit.update', $produits->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        @method('PUT')

                        <input type="text", name="id", style="display: none;" value="{{ $produits->id }}">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="imageProduit" id="image" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="description">Nom</label>
                            <input type="text" name="nom" id="description" class="form-control" value="{{ $produits->nomProduit }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" class="form-control" value="{{ $produits->descriptionProduit }}">
                        </div>
                        <div class="form-group">
                            <label for="price">Prix</label>
                            <input type="number" name="prix" id="price" class="form-control" value="{{ $produits->prixProduit }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('Images/produit.jpg') }}" alt="Image" class="img-fluid">
        </div>
    </div>
</div>
