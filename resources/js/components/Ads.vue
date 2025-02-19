<template>
    <section id="categories">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">
					<a :href="'catalog?cat='+categories[0].id"><div class="category-img" :style="{backgroundImage: backgrounds[0],backgroundSize: 'contain'}"></div></a>
				</div>
				<div class="col-md-3">
					<a :href="'catalog?cat='+categories[1].id"><div class="category-img" :style="{backgroundImage: backgrounds[1], backgroundSize: 'contain'}"></div></a>
				</div>
				<div class="col-md-3">
					<a :href="'catalog?cat='+categories[2].id"><div class="category-img" :style="{backgroundImage: backgrounds[2], backgroundSize: 'contain'}"></div></a>
				</div>
				<div class="col-md-3">
					<a :href="'catalog?cat='+categories[3].id"><div class="category-img" :style="{backgroundImage: backgrounds[3], backgroundSize: 'contain'}"></div></a>
				</div>
			</div>
		</div>
	</section>
</template>
<script>
export default {
    data() {
        return {
			backgrounds: []
        }
    },
    methods: {
		getcategories: function() {
			this.categories.forEach( (a,b) => {
				this.backgrounds.push('url('+URLHOME+'/storage/'+a.image+')');
			});
        }
    },
    mounted() {
        this.getcategories();
		console.log("Esta son las categorias", this.categories);
	},
	props: {
		categories: Array
	}
}
</script>
