import HomeIcon from '@/icons/HomeIcon.vue';
import MessageIcon from '@/icons/MessageIcon.vue';
import HeartIcon from '@/icons/HeartIcon.vue';
import FolderIcon from '@/icons/FolderIcon.vue';
import ChevronLeftIcon from '@/icons/ChevronLeftIcon.vue';
import FilterIcon from '@/icons/FilterIcon.vue';
import DestinationIcon from '@/icons/DestinationIcon.vue';
import LikeIcon from '@/icons/LikeIcon.vue';
import DislikeIcon from '@/icons/DislikeIcon.vue';
import SuperLikeIcon from '@/icons/SuperLikeIcon.vue';
import CloseIcon from '@/icons/CloseIcon.vue';
import SaveIcon from '@/icons/SaveIcon.vue';
import UnknownTypeIcon from '@/components/interestTypes/UnknownTypeIcon.vue';
import MusicTypeIcon from '@/components/interestTypes/MusicTypeIcon.vue';
import ArtTypeIcon from '@/components/interestTypes/ArtTypeIcon.vue';
import FilmTypeIcon from '@/components/interestTypes/FilmTypeIcon.vue';
import MoneyTypeIcon from '@/components/interestTypes/MoneyTypeIcon.vue';

const icons = {
  values: {
    unknownInterest: {
      component: UnknownTypeIcon,
    },
    musicInterest: {
      component: MusicTypeIcon,
    },
    artInterest: {
      component: ArtTypeIcon,
    },
    filmInterest: {
      component: FilmTypeIcon,
    },
    moneyInterest: {
      component: MoneyTypeIcon,
    },
    footerHome: {
      component: HomeIcon,
    },
    message: {
      component: MessageIcon,
    },
    heart: {
      component: HeartIcon,
    },
    folder: {
      component: FolderIcon,
    },
    chevronLeft: {
      component: ChevronLeftIcon,
    },
    filter: {
      component: FilterIcon,
    },
    destination: {
      component: DestinationIcon,
    },
    like: {
      component: LikeIcon,
    },
    dislike: {
      component: DislikeIcon,
    },
    superLike: {
      component: SuperLikeIcon,
    },
    close: {
      component: CloseIcon,
    },
    save: {
      component: SaveIcon,
    },
  },
};

export default icons;
