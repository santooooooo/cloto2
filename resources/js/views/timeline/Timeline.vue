<template>
	  <v-container>
		  <h1>タイムライン</h1> 
		  <v-card max-width="1080" tile class="ma-5" :loading="loading">
      <v-simple-table headers-length:5>
	      <template v-slot:default>
		      <thead>
            <tr>
              <th class="text-left">画像</th>
              <th class="text-left">活動内容</th>
              <th class="text-left">活動時間</th>
              <th class="text-left">達成したこと</th>
              <th class="text-left">次の課題</th>
              <th class="text-left">参考文献</th>
              <th class="text-left">タグ</th>
            </tr>
          </thead>

				  <tbody>
					  <div v-for="kartes in allKartes" :key="kartes.id">
						  {{ kartes.id }}
						  {{ kartes.body }}
					  </div>
				  </tbody>

	      </template>
	    </v-simple-table>
		  </v-card>
	  </v-container>
</template>

<script>
export default {
	data() {
		return {
      loading: false, // ローディング制御
			allKartes: null
		}
	},
	async created() {
		this.loading = true;

    var response = await axios.get('/api/kartes/1');
		this.allKartes = response.data;

		this.loading = false;
	}
};
</script>

<style></style>
