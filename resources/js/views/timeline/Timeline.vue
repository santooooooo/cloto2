<template>
	  <v-container>
		  <v-card>
			  <v-toolbar color="yellow">
				  <v-toolbar-title>タイムライン</v-toolbar-title>
				  <v-spacer></v-spacer>
			  </v-toolbar>
			  
			  <v-row>
				  <v-spacer></v-spacer>
				  <v-col v-for="karte in kartes" :key="kartes.id" cols="12" sm="6" md="4" @click="showKarte = karte">
					  <v-card :ripple="true" class="btn text-left" :loading="loading">
						  <v-card-actions class="white justify-center d-block">
							  <v-img
								  max-width="300"
								  class="mx-auto my-2 rounded-xl"
								  contain
								  :src="$karte(karte, authUser.username) + karte.image"
								  v-if="karte.image"
							  ></v-img>							  

					      <v-row align="center">
						      <v-col class="d-flex" cols="4" sm="2" md="10">
							      <!-- ユーザーアイコン -->
									  <v-avatar>
										  <v-img
											  :src="$storage('icon') + authUser.icon"
											  contain
											  max-width="50">
										  </v-img>
									  </v-avatar>
							      <!-- ユーザー名 -->
							      <v-tooltip max-width="300" top class="fixed-bottom">
											<template v-slot:activator="{ on, attrs }">
											  <div v-bind="attrs" v-on="on">
											    <p class="content m-3">{{ karte.user.username }}</p>
											  </div>
											</template>
											<span>{{ karte.user.username }}</span>
							      </v-tooltip>							      
						      </v-col>
					      </v-row>

					      <!-- 活動内容 -->
					      <v-tooltip max-width="300" top>
									<template v-slot:activator="{ on, attrs }">
									  <div v-bind="attrs" v-on="on">
									    <p class="content text-truncate">{{ karte.body }}</p>
									  </div>
									</template>
									<span>{{ karte.body }}</span>
					      </v-tooltip>				      

					      <!-- 活動時間 -->
								<p class="content">{{ karte.activity_time.slice(0, 5) }}</p>

					      <v-tooltip max-width="300" top>
									<template v-slot:activator="{ on, attrs }">
									  <div v-bind="attrs" v-on="on" v-if="karte.achieve">
									    <p class="content text-truncate">{{ karte.achieve }}</p>
									  </div>

									  <div v-else>
									    <p class="content">未入力</p>
									  </div>
									</template>
									<span>{{ karte.achieve }}</span>
					      </v-tooltip>				      

					      <!-- 次の課題 -->
					      <v-tooltip max-width="300" top>
									<template v-slot:activator="{ on, attrs }">
									  <div v-bind="attrs" v-on="on" v-if="karte.challenge">
									    <p class="content text-truncate">{{ karte.challenge }}</p>
									  </div>

									  <div v-else>
									    <p class="content">未入力</p>
									  </div>
									</template>
									<span>{{ karte.challenge }}</span>
					      </v-tooltip>

					      <!-- 参考文献 -->
					      <v-tooltip max-width="300" top>
									<template v-slot:activator="{ on, attrs }">
									  <div v-bind="attrs" v-on="on" v-if="karte.reference">
									    <p class="content text-truncate">{{ karte.reference }}</p>
									  </div>

									  <div v-else>
									    <p class="content">未入力</p>
									  </div>
									</template>
									<span>{{ karte.reference }}</span>
					      </v-tooltip>				      

						    <!-- タグ -->
					      <v-tooltip max-width="300" top>
									<template v-slot:activator="{ on, attrs }">
									  <div v-bind="attrs" v-on="on" v-if="karte.tags.length">
											<v-chip class="ma-2" v-for="tag in karte.tags" :key="tag.id" :value="tag.id">
											  {{ tag.name }}
											</v-chip>
									  </div>

									  <div v-else>
									    <p class="content">タグなし</p>
									  </div>
									</template>
									<v-chip class="ma-2" v-for="tag in karte.tags" :key="tag.id" :value="tag.id">
									  {{ tag.name }}
									</v-chip>
					      </v-tooltip>

						  </v-card-actions>
					  </v-card>
				  </v-col>
			  </v-row>

		  </v-card>

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
					  <tr v-for="karte in kartes" :key="kartes.id" @click="showKarte = karte">
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on">
                    <p class="content">{{ karte.user.username }}</p>
                  </td>
                </template>
                <span>{{ karte.user.username }}</span>
              </v-tooltip>

              <td>
                <v-img
                  max-width="120"
                  class="mx-auto my-2"
                  contain
                  :src="$karte(karte, authUser.username) + karte.image"
                  v-if="karte.image"
                />

                <v-sheet
                  color="grey lighten-2"
                  width="120"
                  height="120"
                  class="mx-auto my-2"
                  v-else
                ></v-sheet>
              </td>

              <!-- 活動内容 -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on">
                    <p class="content">{{ karte.body }}</p>
                  </td>
                </template>
                <span>{{ karte.body }}</span>
              </v-tooltip>

              <!-- 活動時間 -->
              <td>
                <p class="content">{{ karte.activity_time.slice(0, 5) }}</p>
              </td>

              <!-- 達成したこと -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.achieve">
                    <p class="content">{{ karte.achieve }}</p>
                  </td>

                  <td v-else>
                    <p class="content">未入力</p>
                  </td>
                </template>
                <span>{{ karte.achieve }}</span>
              </v-tooltip>

              <!-- 次の課題 -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.challenge">
                    <p class="content">{{ karte.challenge }}</p>
                  </td>

                  <td v-else>
                    <p class="content">未入力</p>
                  </td>
                </template>
                <span>{{ karte.challenge }}</span>
              </v-tooltip>

              <!-- 参考文献 -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.reference">
                    <p class="content">{{ karte.reference }}</p>
                  </td>

                  <td v-else>
                    <p class="content">未入力</p>
                  </td>
                </template>
                <span>{{ karte.reference }}</span>
              </v-tooltip>

              <!-- タグ -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.tags.length">
                    <p class="content">タグ{{ karte.tags.length }}個</p>
                  </td>

                  <td v-else>
                    <p class="content">タグなし</p>
                  </td>
                </template>

                <v-chip class="ma-2" v-for="tag in karte.tags" :key="tag.id" :value="tag.id">
                  {{ tag.name }}
                </v-chip>
              </v-tooltip>
					  </tr>
				  </tbody>

	      </template>
	    </v-simple-table>
		  </v-card>

	    <KarteDialog :karte="showKarte" @close="showKarte = $event" />
	  </v-container>
</template>

<script>
import KarteDialog from '@/components/mypage/KarteDialog';

export default {
	data() {
		return {
      loading: false, // ローディング制御
			kartes: null,    //カルテ一覧
      showKarte: null, // 詳細を表示するカルテ
		}
	},
	components: {
		KarteDialog
	},
	async created() {
		this.loading = true;

		var response = await axios.get('/api/kartes');
		this.kartes = response.data;
		console.log(this.kartes);

		this.loading = false;
	},
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
};
</script>

<style lang="scss" scoped>
tbody {
  tr {
    cursor: pointer;

    .content {
      width: 100px;
      margin: 0;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }
  }
}
</style>
